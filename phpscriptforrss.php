    <?php 

      // далее присваиваем адресу генерируемой RSS ленты id паблика VK
      $rss = "https://vkapi.ga/functional/vk2rss/rss.php?access_token=7e34d1f0146b636911112acf9b1ec307408a99a42064a17082b0387966f640168c21335aae99d9eaeb70d&id=grecha_team". 176222313 . "&count=10&include=%23memes%40grecha_team&exclude="; 
      
      // засасываем RSS ленту VK в переменную $page одно строкой 
      $page = file_get_contents($rss); 
      
      // далее пошла жоская кастрация текста регулярками (кто в теме поймет) 
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
		
      //Возвращаем обработанную RSS ленту 
      echo $newpage; //конец 
    ?> 