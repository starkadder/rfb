#!/usr/bin/perl
#########################################################################
#
# script: bbcindex
# author: Tom Schweiger tom@starkadder.net
# date:   January 29, 2012
# args:   url or file
#
# This script updates database with bbc iplayer index
#
#########################################################################
use strict;
use DBD::mysql;
$ENV{'USERPROFILE'} = "/music/shows";
my $index = $ENV{'USERPROFILE'} . "/.get_iplayer/radio.cache";
#
# update cache
#
print "update index\n";
#`/usr/bin/get-iplayer --type=radio >/dev/null`;
print "update database\n";


my $database = "rfb";
my $host = "localhost";
my $user = "root";
my $password = "radio1";


my $dbh = DBI->connect("DBI:mysql:database=$database;host=$host", $user, $password, {'RaiseError' => 1});

my $sql = "SELECT bbcindex FROM bbcindex";
my $sth = $dbh->prepare($sql);
$sth->execute();
my %shows = ();
while (my $ref = $sth->fetchrow_hashref()) {
    $shows{$ref->{'bbcindex'}} = 0;
}
$sth->finish();

open(INDEX,$index) or die "cannot open $index\n";
my $line = <INDEX>; # ignore header
while ($line = <INDEX>) {
    chomp($line);
    $line =~ s/\"//g;
    my @items = split(/\|/,$line);
    if ( exists $shows{$items[0]}) {
	$shows{$items[0]} = 1;
    }
    else {
	my $sql = "INSERT INTO bbcindex VALUES (\"" . join("\",\"",@items) . "\")";
	$dbh->do($sql);
    }
}    

foreach my $item (keys %shows) {
    my $sql = "DELETE FROM bbcindex WHERE bbcindex = $item";
    if ($shows{$item} == 0) {
	my $sql = "DELETE FROM bbcindex WHERE bbcindex = $item";
	$dbh->do($sql);
    }
}    
$dbh->disconnect();

exit;








