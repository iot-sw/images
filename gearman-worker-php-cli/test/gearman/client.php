<?php

function done(GearmanTask $task){

  echo $task->data() . "\n";

}


# change this for the real ip or hostname of the gearmand.
$hostname  = '172.17.0.4';

$workload = <<<'WKLD'
Wikipedia (/ˌwɪkɪˈpiːdiə/ (About this soundlisten), /ˌwɪkiˈpiːdiə/
(About this soundlisten) WIK-kee-PEE-dee-ə) is a multilingual online
encyclopedia, based on open collaboration through a wiki-based content
editing system. It is the largest and most popular general reference work
on the World Wide Web,[3][4][5] and is one of the most popular websites
ranked by Alexa as of June 2019.[6] It features exclusively free content
and no commercial ads, and is owned and supported by the Wikimedia Foundation,
a non-profit organization funded primarily through donations.[7][8][9][10]

Wikipedia was launched on January 15, 2001, by Jimmy Wales and Larry
Sanger.[11] Sanger coined its name,[12][13] as a portmanteau of wiki
(the Hawai'ian word for "quick"[14]) and "encyclopedia". Initially an
English-language encyclopedia, versions in other languages were quickly
developed. With 5,893,459 articles,[notes 3] the English Wikipedia is the
largest of the more than 290 Wikipedia encyclopedias. Overall, Wikipedia
comprises more than 40 million articles in 301 different languages[15] and
by February 2014 it had reached 18 billion page views and nearly 500 million
unique visitors per month.[16]

In 2005, Nature published a peer review comparing 42 hard science articles
from Encyclopædia Britannica and Wikipedia and found that Wikipedia's level
of accuracy approached that of Britannica,[17] although critics suggested
that it might not have fared so well in a similar study of a random sampling
of all articles or one focused on social science or contentious social
issues.[18][19] The following year, Time magazine stated that the open-door
policy of allowing anyone to edit had made Wikipedia the biggest and possibly
the best encyclopedia in the world, and was a testament to the vision of
Jimmy Wales.[20]

Wikipedia has been criticized for exhibiting systemic bias, for presenting
a mixture of "truths, half truths, and some falsehoods",[21] and for being
subject to manipulation and spin in controversial topics.[22] However, Facebook
announced that by 2017 it would help readers detect fake news by suggesting
links to related Wikipedia articles. YouTube announced a similar plan in 2018.
WKLD;

$client = new GearmanClient();

$client->addServer($hostname);

$client->setCompleteCallback('done');

$client->addTask('wc', $workload);

$client->runTasks();
