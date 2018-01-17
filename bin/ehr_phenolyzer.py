import argparse,os,subprocess
import glob,sys,distutils.spawn
import pymetamap as pt

# ###add path in python # ###
# very import, don't forget to add the path.
# add path for Metamap and 
os.environ["PATH"] += os.pathsep
os.environ["PATH"] += os.pathsep.join(["/Users/congliu/public_mm/bin","/Users/congliu/Project/phenolyzer"])
# ###########################

###parse the arguments
parser = argparse.ArgumentParser(description='Get ranked gene ids based on EHR medical notes',
                                 epilog="One step from EHR records to ranked gene list.Before running, please install Phenolyzer, Metamap first")
parser.add_argument('-i','--input', dest='input',required=True,
                    help='medical note file in txt format')
parser.add_argument("-p","--prefix",dest='prefix',default="out",
                    help='the prefix for the output file')
parser.add_argument("-d","--outdir",dest='outdir',default="./",
                    help='the path to the output folder')
parser.add_argument("-m","--omim",dest='omim',default=os.path.join(os.path.dirname(__file__), './db/OMIM_HGNCGenes.txt'),
                    help='path to the OMIM txt file')
parser.add_argument("-x","--obo",dest='obo',default=os.path.join(os.path.dirname(__file__),'./db/hp.obo'),
                    help='path to HPO obo file')
if len(sys.argv)==1:
    parser.print_help()
    sys.exit(1)
args = parser.parse_args()
args=vars(args) # convert to dictionary,and accessed by: args['input']

###check third-party tools availabilities
if not (distutils.spawn.find_executable("skrmedpostctl")):
    print("Error: Metmap server skrmedpostctl not found")
    sys.exit()
if not (distutils.spawn.find_executable("metamap")):
    print("Error: Metamap not found, please install Metamap")
    sys.exit()
if not (distutils.spawn.find_executable("disease_annotation.pl")):
    print("Error: disease_annotation.pl not found, please install Phenolyzer")
    sys.exit()

###run command lines in python
def run_command(command_line):
    return os.popen(command_line).read()
###create outdir
phenolyzer_outdir="mkdir -p {0}".format(args["outdir"])
print(run_command(phenolyzer_outdir))

###handle no-ASCII characters in the medical notes, otherwise will lead to system error in metamap
def removeNonAscii(s):
    return "".join(i for i in s if ord(i)<128)

input_tmp_name=args["outdir"]+"/"+args["input"].split("/")[-1]+".tmp"
input_tmp=open(input_tmp_name,"w")
input_str=""
for line in open(args["input"]):
    input_str=input_str+line

input_str_noascii=removeNonAscii(input_str)
input_tmp.write(input_str_noascii)
input_tmp.close()

###run metamap
pt.run_metamap(input_tmp_name,args['prefix'],args['obo'],args['outdir'])
hpo_file=args['prefix']+".hpo.txt"
#start the server
#print(run_command("skrmedpostctl start"))
#metamap_command_line="metamap -I -p -J -K -8 --conj cgab,genf,lbpr,lbtr,patf,dsyn,fndg -R 'HPO' {0} {2}/{1}.tmp.metamap.o".format(input_tmp_name,args["prefix"],args["outdir"])
#get_metamap_terms="grep 'C[0-9][0-9].*:*' {1}/{0}.tmp.metamap.o -o | sort | uniq | cut -d ':' -f 2 | sed 's/([^()].*)//g' | sed 's/\[[^][]*\]//g' > {1}/{0}.tmp.names".format(args["prefix"],args["outdir"])
#
#print("metamap command used:")
#print(metamap_command_line)
#print(run_command(metamap_command_line))
#print("HPO term extraction:")
#print(run_command(get_metamap_terms))
#print(get_metamap_terms)
##stop the server
#print(run_command("skrmedpostctl stop"))

###run phenolyzer

print("run phenolyzer:")
phenolyzer_command="disease_annotation.pl -f -p -ph -logistic -addon DB_DISGENET_GENE_DISEASE_SCORE,DB_GAD_GENE_DISEASE_SCORE -addon_weight 0.25 {1}/{0} -out {1}/{2}".format(hpo_file,args["outdir"],args['prefix'])
print(phenolyzer_command)
print(run_command(phenolyzer_command))

###extract the ranked genes list
with open(args["outdir"]+"/"+args["prefix"]+".final_gene_list") as f:
    header=f.readline()
    seed_genes=[]
    predicted_genes=[]
    for line in f:
        (rank,gene,id_,score,status)=line.rstrip().split("\t")
        if status=="SeedGene":
            seed_genes.append(gene)
        else:
            predicted_genes.append(gene)
    final_genes=seed_genes+predicted_genes

###get OMIM gene list
mim_gene_dict={}
with open(args["omim"]) as f:
    for line in f:
        line=line.rstrip()
        genes=line.split(",")
        for gene in genes:
            mim_gene_dict[gene]=0

omim_genes=[]
for gene in final_genes:
    if gene in mim_gene_dict:
    #if mim_gene_dict.has_key(gene):
        omim_genes.append(gene)

###output the result
outfile=open(args["outdir"]+"/"+args["prefix"]+".EHRPhenolyzer.Genes.txt","w")
outfile.write("rank\tgene\n")
i=0
for gene in final_genes:
    i+=1
    outfile.write(str(i)+"\t"+gene+"\n")
outfile.close()

outfile=open(args["outdir"]+"/"+args["prefix"]+".EHRPhenolyzer.OMIMGenes.txt","w")
outfile.write("rank\tgene\n")
i=0
for gene in omim_genes:
    i+=1
    outfile.write(str(i)+"\t"+gene+"\n")
outfile.close()

###clean the work space
for file in glob.glob(args["outdir"]+"/"+args["prefix"]+".tmp*"):
    if os.path.isfile(file):
        os.remove(file)

if os.path.isfile(input_tmp_name):
    os.remove(input_tmp_name)
print("completed!")
