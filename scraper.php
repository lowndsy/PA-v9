<?

// This is a basic price position checker example.
// For educational use only - the code is fully commented and has been designed to be easy to deconstruct
// This resource is meant to show how to make a simple price scanner on a reasonably complicated site.
// the output is very basic and much less detailed than the commercial scrapers that scrape sites like uSwitch every day
// It deals with complex structures using redundancy - each piece of info is stored more than once in one form or another so everything can be verified.
// It does the same job as a person and takes the same server load as one person visiting a few pages every morning. As soon as you gather more than one brand it probably saves a lot of bandwidth

// This is a new variation to show how vague pimary keys can be an advantage. 
// If a deal has already been identified it won't be stored again.

     // Cool resources for using the SIMPLE DOM object
     // http://nimishprabhu.com/top-10-best-usage-examples-php-simple-html-dom-parser.html
     // http://stackoverflow.com/questions/6900144/get-title-from-link-php-simple-html-dom-parser
     // http://code.tutsplus.com/tutorials/html-parsing-and-screen-scraping-with-the-simple-html-dom-library--net-11856
     // https://davidwalsh.name/php-notifications
     // https://classic.scraperwiki.com/docs/python/python_datastore_guide/

require 'scraperwiki.php';

require 'scraperwiki/simple_html_dom.php';

//// SET UP
// Build the list of URLs to analyse

$Targets = array(
"https://www.uswitch.com/mobiles/huawei-p30-pro-deals/?variant=128gb-black",
"https://www.uswitch.com/mobiles/huawei-p20-deals/?variant=128gb-black",
"https://www.uswitch.com/mobiles/huawei-p20-pro-deals/?variant=128gb-black",
"https://www.uswitch.com/mobiles/huawei-mate-20-deals/?variant=128gb-black",
"https://www.uswitch.com/mobiles/huawei-mate-20-pro-deals/?variant=128gb-black"
);

foreach ($Targets as $target)
{

// Join with the correct ? or &
if (strpos($target, '?') !== false) {$joiner="&";} ELSE {$joiner="?";}

  
$newtarget[]=$target.$joiner."upfront_cost=0-150&networks=ee";
$newtarget[]=$target.$joiner."upfront_cost=0-150&networks=o2";
	
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=4000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=ee";  
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=ee";  

$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=o2";
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=02";
$newtarget[]=$target.$joiner."data=4000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=o2";  
$newtarget[]=$target.$joiner."data=4000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=o2";  
  
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=10000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=ee";  
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=ee";  

$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=o2";
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=02";
$newtarget[]=$target.$joiner."data=10000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=o2";  
$newtarget[]=$target.$joiner."data=10000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=o2";  
  
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=30000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=ee";  
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=ee";  

$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=o2";
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-150&sort_by=total_cost&resellers=true&networks=02";
$newtarget[]=$target.$joiner."data=30000&monthly_cost=0-40&upfront_cost=0-150&sort_by=monthly_cost&resellers=true&networks=ee";
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-0&sort_by=monthly_cost&resellers=true&networks=o2";  
$newtarget[]=$target.$joiner."data=30000&upfront_cost=0-0&sort_by=total_cost&resellers=true&networks=o2";  
  

}

//  Possible variables:
//  ?minutes=
//  &texts=
//  &data=
//  &monthly_cost=
//  &handset_cost=
//  &sort_by=
//  &contract_length=
//  &resellers=true
//  &networks=




// Set the date as a constant. 
// It is possible for the price scanner to take a couple of minutes to run, so this makes sure each row has the same time stamp to make organising in Excel etc easier
// Note that the datestamp doesn't take things like British Summer Time into account - easy to fix, but no real point for this tutorial

$usedate=gmdate('d-m-Y H:i');


$dom = new simple_html_dom();

// Start a loop going through each of the URLs above

foreach ($newtarget as $target)

{

unset($tocommit);
unset($html);
unset($contractdetails1); 
unset($contractdetails2); 
unset($contractdetails3); 
unset($contractdetails4); 
unset($contractdetails5); 
unset($contractdetails6); 
unset($fulltext); 
unset($thisphone); 
unset($notes); 

$tocommit = array();
	
// Turn target url into the final URL. 

// This gives us the option to add an extra query string to all URLs, not used at the moment.	

$comptarget=$target.'';

     // This is the only command which is specific to Morph.io 

     // If you use this code on a different automation platform or your own server simply retrieve the page in a different way - loads of options, including the one built into simple_html_dom.php

     // Read in a page
     $html = scraperwiki::scrape("$comptarget");



     // Clear the dom object whenever you can - to help memory usage	
     $dom->clear();


     // Process the html into an object that the implehtmldom library can use
     $dom->load($html);
    
     //fetch all TRs which we think are products

  
     $contractdetails1 = array();
     $contractdetails2 = array();
     $contractdetails3 = array();
     $contractdetails4 = array();
     $contractdetails5 = array();
     $contractdetails6 = array(); 
     $tags = array(); 
     $fulltext = array(); 

	// This var is used to control the loop and record which position a deal is in

	$thispos=1;

     // Extract the Handset from the top of the page DONE

     foreach($dom->find('h1.model-name') as $p) 

     {

     $thisphone=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }

     // Extract the contract description from a DIV with the right class name

     foreach($dom->find('section.nu-table__primary-container') as $p) 

     {

     $contractdetails1[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }


     // Extract secondary contract info from a DIV with the right class name

     foreach($dom->find('section.nu-table__secondary-container') as $p) 

     {

     $contractdetails2[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }

	// Extract primary contract info from a DIV with shared names

	// shoudl show 20 rows

     foreach($dom->find('div.primary-info-block') as $p) 

     {

     $contractdetails3[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }

	// Extract contract info from a DIV with shared names

	// shoudl show 30 rows

     foreach($dom->find('div.secondary-info-block') as $p) 

     {

     $contractdetails4[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }


     foreach($dom->find('div.nu-table__desktop-retailer') as $n) 

     {

     // Pull the retailer image SRC tag.
     // Using Preg match isn't generally recomended, but this is a pretty simple job so it should be ok
     // This is a demo to show how to do it - we don't strictly need the value for the scraper.
     // this could be done in a single line, but that would be pretty intense to understand

     $image=preg_match( '@src="([^"]+)"@' , $n->innertext, $match );

     $NetworkCode = array_pop($match);  

     $contractdetails5[$target][]=$NetworkCode;

     }

	



     // Extract the network / brand from a DIV with the right class name
     foreach($dom->find('div.nu-table__deal-info-text') as $p) 

     {

     $contractdetails6[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );

     //echo $p->plaintext;

     }	
	

     // Extract the whole text for posterity and error checking
     foreach($dom->find('div.nu-table__card-flow') as $p) 
     {
     $fulltext[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );
     //echo $p->plaintext;
     }	


     // Extract the tags from a section with the right class name
     foreach($dom->find('section.nu-table__tag-container') as $p) 
     {
     $tags[$target][]=preg_replace( '/\s+/', ' ', $p->plaintext );
     //echo $p->plaintext;
     }	

	

     // COMPILE THE FINAL ARRAY

	

     foreach($dom->find('div.nu-table__card') as $a) 

     {
     // START LOOP
     // Check there is some content to loop through.

      if ( $a->innertext !== false ) 



       { 

          // Prepare the empty notes VAR in case we need it.
          $notes ='';

            

          // Use the time/date stamp set at the start of the script
           $tocommit[$thispos]['datestamp']=$usedate;

           

           // The page being targeted
           $tocommit[$thispos]['page']=$target;



           // The page being targeted
           $tocommit[$thispos]['phone']=$thisphone;

           

           // The position in the price table
	   // Don't forget every array starts at pos 0, so everythign is -1
           $tocommit[$thispos]['position']=$thispos;



	   //$tocommit[$thispos]['dealsummary']=$contractdetails1[$target][$thispos-1].$contractdetails2[$target][$thispos-1];

	      

	   $tocommit[$thispos]['dealfeatures']=$contractdetails2[$target][$thispos-1];
   
	   $tocommit[$thispos]['dealheadlines']=$contractdetails1[$target][$thispos-1];

	   $tocommit[$thispos]['data']=$contractdetails3[$target][$thispos*2-2];   

	   $tocommit[$thispos]['monthly']=$contractdetails3[$target][$thispos*2-1];         

	   $tocommit[$thispos]['upfront']=$contractdetails4[$target][$thispos*3-3];         

	   $tocommit[$thispos]['total']=$contractdetails4[$target][$thispos*3-2];   

	   $tocommit[$thispos]['contract']=$contractdetails4[$target][$thispos*3-1];   
	 
	   // Not storimg the image src at atm

	   // $tocommit[$thispos]['image']=$contractdetails5[$target][$thispos-1];    

	      

	   $tocommit[$thispos]['networkbrand']=$contractdetails6[$target][$thispos-1];    

           

           // Record the full html of the entry or just the text content, for debugging
           // This is the part which takes up most DB space
           // "outertext" stores the entire html, currently running "plaintext" to save DB space
           //$tocommit[$thispos]['fullcode']=$a->outertext;
         
           $tocommit[$thispos]['fullcode']=preg_replace( '/\s+/', ' ', $a->plaintext );
 
           // Make a convenient unique primary key using MD5. By including the seconds in the time it should alyways be unique           
	   // encoding with MD5 is optional, but it keeps the database smaller

	   // This version purposely uses a pretty general Primary key
           // - duplication is possible, which will stop the same deal being stored more than once
	   // - date - phone - deal description - networkbrand
            $tocommit[$thispos]['prikey']=MD5($usedate.$thisphone.$contractdetails2[$target][$thispos-1].$contractdetails6[$target][$thispos-1]);


           

           // Add any notes to last column

               IF ($notes) 

                    {

                    $tocommit[$thispos]['notes']=$notes;

                    unset($notes);

                    }

                    ELSE 

                    $tocommit[$thispos]['notes']='';

           

           // Store in DB

	      

	      //print_r($tocommit[$thispos]);

	      

           scraperwiki::save(array('prikey'), $tocommit[$thispos]);

	      		      

           // Write symbol to screen on commit

          // echo '+';

       }

       // END LOOP TARGETING SPECIFIC DEAL

	// echo $tocommit[$thispos]['page'];



     // Increment the position by 1 

     $thispos++;

     }


     // END LOOP TARGETING SPECIFIC URL

// DESTROY THE PARSER AND VARS READY FOR THE NEXT ITERATION

// Important - Morph.io and scraperwiki have the odd memory leak that will slow things down or crash if you don't do this

$dom->clear();

	

// Just good manners...	

unset($tocommit);
unset($html);
unset($contractdetails1); 
unset($contractdetails2); 
unset($contractdetails3); 
unset($contractdetails4); 
unset($contractdetails5); 
unset($contractdetails6); 
unset($fulltext); 
unset($thisphone); 
unset($notes); 

}

// END LOOP FOR THE ENTIRE LIST OF URLS

// Display a quick completion message. You could put summary info about the scan in here if you like
// If this doesn't show it could mean the scraper crashed. Check the target URL array is correctly formatted - easy to have a stray or missing comma 

echo '

Check Complete: '.$usedate;

?>
