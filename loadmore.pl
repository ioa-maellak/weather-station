#!/usr/bin/perl

use CGI;

my $q = CGI->new;

# print $q->header();

$query_string = $ENV{'QUERY_STRING'};
($field_name, $value) = split (/=/, $query_string);

$value *= 2;
print $q->redirect ("index.php?lim=$value");

