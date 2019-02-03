#!/usr/bin/perl
use LWP::Curl;

my $lwpcurl = LWP::Curl->new();
my $content = $lwpcurl->get($ARGV[0]); 

print $content;

