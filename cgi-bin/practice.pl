use strict;
my $string="abc abc abc";
$string=~s/(abc)/$1lalala/g;
print $string;