#!/usr/bin/perl
#########################################################################
#
# script: playlink
# author: Tom Schweiger tom@starkadder.net
# date:   January 20, 2007
# args:   url or file
#
# This script starts mplayer playing a url or file
# It fetchs and parses the url if it is a podcast
# It checks if the file is a playlist (.pl, .mu3, .ram, ...) 
#
#########################################################################
use strict;
use DBD::mysql;

my @list = glob("/music/*/*/.rfb.m3u");

my $database = "rfb";
my $host = "localhost";
my $user = "root";
my $password = "radio1";

my $dbh = DBI->connect("DBI:mysql:database=$database;host=$host", $user, $password, {'RaiseError' => 1});

for my $item (@list) {
    my ($foo,$music,$artist,$album,$playlist) = split(/\//,$item);
    $artist =~ s/_/ /g;
    $album =~ s/_/ /g;
    $artist =~ s/\b(\w)/\U$1/g;
    $album =~ s/\b(\w)/\U$1/g;
    print "$artist | $album\n";

    my $sql = sprintf("INSERT INTO albums (name, url) VALUES ('%s - %s', '%s')",
		      $artist, $album, $item);
    $dbh->do($sql);
}
$dbh->disconnect();

exit;








