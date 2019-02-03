#!/usr/bin/perl

$vol = `osascript -e 'output volume of (get volume settings)'`;
chomp($vol);
print "old volume = $vol\n";
$vol -= 4;
`osascript -e 'set volume output volume $vol'`;
print "new volume = $vol\n";
