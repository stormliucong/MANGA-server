#!/usr/bin/perl
use strict;
use warnings;

system("perl integrate_gene_disease.pl");
system("perl compile_gene_disease_score.pl");
system("perl compile_disease_words.pl");
system("perl compile_hot_disease_words.pl");
system("cp hot_disease_term.txt ../../html/");


#system("perl integrate_HTRI.pl"); no update of the database
#system("perl integrate_binary_protein_interaction_score.pl"); no update of the database
system("perl integrate_biosystem_score.pl");
#system("perl compile_gene_family.pl"); no update avaiable
