<?php

$content = array(
  "Baleine de Cuvier" => "La baleine de Cuvier ou baleine à bec de Cuvier ou ziphius de Cuvier, également connue sous le nom de baleine à bec d'oie (Ziphius cavirostris), est la seule espèce actuelle du genre Ziphius. C'est la baleine à bec la plus abondante et la plus largement répandue1, probablement plus de 100 000 individus2, mais elle reste généralement discrète et a été peu observée.",
  "Dauphin bleu et blanc" => "Le dauphin bleu et blanc est l'une des cinq espèces du genre Stenella. Il est découvert par le savant allemand Franz Meyen en 1833. Son épithète spécifique, coeruleoalba, provient de l'agglutination des mots cæruleus, « bleu foncé », et albus, « blanc », ses principales caractéristiques physiques.",
  "Rorqual commun" => "Le rorqual commun (Balaenoptera physalus) est une espèce de cétacé de la famille des Balaenopteridae. Après la baleine bleue, et avec une longueur d'environ 20 mètres, c'est le deuxième plus grand mammifère vivant sur la planète1. On le trouve dans tous les océans, ainsi qu'en mer Méditerranée, il a une grande longévité, probablement une centaine d'années. L'espèce, protégée après avoir été considérée comme menacée par l'UICN, passe au statut « vulnérable » en 20182."
);

$contentCommon = array(
  "Les Balénoptéridés (Balaenopteridae), également appelées rorquals, forment une famille de cétacés à fanons, qui se distinguent par leurs sillons ventraux au niveau de la gorge. Cette famille regroupe une dizaine d'espèces encore vivantes, parmi lesquelles les plus grandes baleines, dans deux genres. Le nombre d'espèces varie selon les classifications, en effet plusieurs espèces n'ont été identifiées que depuis la mise en place des analyses phylogénétiques. Les plus petites espèces sont les baleines de Minke, avec leurs 7 à 10 mètres, et la plus grande est la baleine bleue.",
  "En zoologie, le terme baleine (du grec ancien φάλαινα, phálaina, « baleine ») désigne certains mammifères marins de grande taille classés dans l'ordre des Cétacés. C'est un terme générique qui s'applique aux espèces appartenant au sous-ordre des mysticètes, les cétacés à fanons ainsi que, improprement, à certaines espèces appartenant aux odontocètes, les cétacés à dents. Le petit de la baleine s'appelle le baleineau.",
  "Dauphin est un nom vernaculaire ambigu désignant en français certains mammifères marins et fluviaux appartenant à l'ordre des cétacés.",
  "Les globicéphales (Globicephala) sont un genre de cétacés odontocètes de la famille des delphinidés (les dauphins océaniques). Ils sont parfois appelés « dauphins-pilotes » car on les voit fréquemment dans le sillage ou à l’étrave des navires (en anglais finned pilot whale). Dauphins au melon frontal fortement développé, ce sont des animaux sociaux qui se déplacent le plus souvent en bandes pouvant aller d'une dizaine à plusieurs centaines d'individus1."
);

$images = array(
  "Baleine" => "baleine.jpeg",
  "Dauphin" => "dauphin.jpeg",
  "Globicephales" => "globicephales.jpeg",
);

function getImages($name) {
  switch ($name) {
    case 'Baleine á bec de Cuvier':
    case 'Baleine à bec de Sowerby':
    case 'Baleine à bosse':
    case 'Baleine de Cuvier':
      return '<img class="mw-100" src="/assets/images/baleine.jpeg" />';
      break;
    case 'Dauphin à flancs blancs':
    case 'Dauphin à nez blanc':
    case 'Dauphin bleu et blanc':
    case 'Dauphin commun':
      return '<img class="mw-100" src="/assets/images/dauphin.jpeg" />';
      break;
    case 'Globicéphale noir':
      return '<img class="mw-100" src="/assets/images/globicephales.jpeg" />';
      break;
    default:
    return '<img class="mw-100"  src="/assets/images/all.jpg" />';
      break;
  }
}
