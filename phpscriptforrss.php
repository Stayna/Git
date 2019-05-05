    <?php 

 
      $rss = "https://vkapi.ga/functional/vk2rss/rss.php?access_token=7e34d1f0146b636911112acf9b1ec307408a99a42064a17082b0387966f640168c21335aae99d9eaeb70d&id=grecha_team&count=10&include=%23memes%40grecha_team&exclude="; 
      

      $page = file_get_contents($rss); 
      

      $newpage = preg_replace_callback("|(CDATA\[)(.+)(\]\])|imU",  
      function ($matches) { 
        $t0 = preg_replace ("|\<\/br\>|imU", "\t", $matches[2]);     
        $t1 = strip_tags($t0, "<img>"); 
        $t2 = preg_replace_callback ("|(\<img src=')(.+)('/\>)|imU", 
        function ($matches) { 
          return $matches[2]; 
        }, $t1); 
      $t3 = preg_replace ("|http.+\.jpg|imU", "\t$0\t", $t2); 
      $text = $matches[1] . $t3 . $matches[3]; 
      $ntext = preg_replace('|[\r\n\s]+|imU', " ", $text); return $ntext; }, "$page"); 

      echo $newpage;
    ?> 