#Homework
this homework is part of an job interview.
##Task.
see task.txt.
##Solution.

After reading task I decided I wont be fancy and I will only have index and class file, with JS and CSS withing index file. I wont be checking for all the possible errors, as my class will be expected to work for one specific use. I will try to make my methods general, thought. I'm not going procedural, anyway.  


> Load and parse the following table using PHP: https://www.nike.sk/app/statistika/20590/7/ (use the table at the top titled “Hokej - Česko Extraliga - CELKOM”).

So I guess I should not use any libraries to do the job for me, but instead do it with what PHP can give me. Hence `file_get_contents` and my first `public function tableToJSON($url)`, where I will be saving values from table to JSON file. 

I could go few ways here, eg. regex, but after some harsh time with old good regex, I decided to change to the DOM. I find it more readable, so why not. Getting to `<td>` elements is easy: I traverse the rows from `<table>` and then I save values in JSON file. Example of one row saved to file is as follows. 

`"1":["1","Slavia","52","23","11","3","15","138:111","94","v2","d1","d1p","v1","v1p","d1","d1p","v1","d2","v1"]`

I strip first row, as it's `<th>` and it gets empty (because I am looking for `<td>`s here). 

As I mentioned before, I do not check for errors here. If your file wont get saved, check whether your user has the rights. The same with loading the table from nike.sk site, might get error if your connection times out. 

> Generate a new HTML table in PHP from the collected data. 

Hence `public function JSONtoTable($file,$table_header)` which rebuilds the table from JSON `$file`. I added `$table_header` to provide header for table. 

> The table should have sorting functionality for the first 9 columns. In HTML use JavaScript in combination with jQuery or mootools. The page should not reload with every sorting/event. Ajax can be used or sorting can be performed directly in JavaScript. When using Ajax, don’t send/receive HTML but only JSON data. Sort numbers as numeric values not as text.

The same as with PHP, I guess I should not use libraries that would allow me to sort without my work. 

I went with pure JavaScript, as would be pointless to use external libraries like jQuery in this case. As the main role of JavaScript is to deal with DOM, the way of thinking in here is simple: see what column you are about to sort and rebuild the table accordingly. 

First I create array of Objects with old index and value (as I will need it when rebuilding). Then I sort them based on whether the values are numerical, text or just reverse when I am trying to sort the same column as before. 

In the beggining I set `var previouslySorted = 0;` as first column can be just reversed when sorting after first visit of site.  

When sorting text I use `Intl.Collator("cz")` to make sure special characters get sorted as expected in Czech labuage (`'Č. Budějovice'`). 

No idea how sorting by 'Skóre' should work, so I do not sort it. 

After sorting is done, I rebuild the tbody and replace the old one. 

> Use :hover states on active elements. From the design perspective, keep it simple and usable. If you can make it look good, you get a special badge. :) 

I like simple, so let's use some grey and lightgrey. Hope you like it. 





