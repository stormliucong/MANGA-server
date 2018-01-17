#!/usr/bin/perl
use warnings;
use strict;
use GenomicsServer qw(:COMPLETE :DEFAULT);

GenomicsServer::executeProgram("perl /Users/congliu/Sites/phenolyzer-server/cgi-bin/serve_ehr.pl 2> /Users/congliu/Sites/phenolyzer-server/work/3/serve_ehr_error_log") ;

