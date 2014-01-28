
<?php
include 'globals.php';


$api_url = 'http://it.wikipedia.org/w/api.php';
$username = 'alexrighetto';
$password = 'kowalsky1';



try
{
    $wiki = new Wikimate($api_url);
    
}
catch ( Exception $e )
{
    echo "<b>Wikimate error</b>: ".$e->getMessage();
}
// define page title
$query = 'Castello_di_Verrès';


$page = $wiki->getPage($query);

//$page->getText();

$string = $page->getSection(0, false);


// load wikitext converter
require_once 'Text/Wiki.php';

// instantiate a Text_Wiki object from the given class
// and set it to use the Mediawiki adapter
$wiki = & Text_Wiki::factory('Mediawiki', array(
        'Prefilter',
        'Delimiter',
        'Code',
        'Function',
        'Html',
        'Raw',
        'Include',
        'Embed',
        'Anchor',
        'Heading',
        'Toc',
        'Horiz',
        'Break',
        'Blockquote',
        'List',
        'Deflist',
        'Table',
        'Image',
        'Phplookup',
        'Center',
        'Newline',
        'Paragraph',
        'Url',
        'Freelink',
        'Interwiki',
        'Wikilink',
        'Colortext',
        'Strong',
        'Bold',
        'Emphasis',
        'Italic',
        'Underline',
        'Tt',
        'Superscript',
        'Subscript',
        'Revise',
        'Tighten'
    )
);

// set some rendering rules  
//$wiki->setRenderConf('Plain', 'anchor', 'text', '');

  
//remove links
 
$ptn = "/({{){1}([^{{]*)(}}){1}/";
$str = $string;
$rpltxt = "";
$string =  preg_replace($ptn, $rpltxt, $str);

//remove images

$ptn = "/((thumb\|)([^\|]+\|)([^\|]+\|))/";
$str = $string;
$rpltxt = "";
$string =  preg_replace($ptn, $rpltxt, $str);

?>
<html>
  <head>
   <meta charset="UTF-8"> 
  </head>
  <body>
    <h2>Page result for '<?php echo $query; ?>'</h2>
    <div>
      <?php echo $wiki->transform($string, 'Plain'); ?>
      </script>
    </div>
  </body>
</html>

