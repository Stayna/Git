    <?php 
    // ������� v0.1 by Jinnd 08.03.2019 
    // 57846937 - id ������� ��� (��� �������) 
      // $vk =''; // ��������� ��������� ������ �������� 
      
      // // ��������� �������� �� �������� ������� id ������� vk � �������� �� �� ��������   
      // if(isset($_GET['vk']) and is_numeric($_GET['vk'])){     
        // $vk = $_GET['vk']; // ���� ������ , �� ����������� id ���������� $vk 
      // } 
      // else { 
        // //����� ����� ��������� �� ������ � ���������������� ���������� �������    
        // echo "�� �� ������ id ������� � ������ ������� ����� ���������� 'vk' !";    exit(); 
      // } 
      
      // ����� ����������� ������ ������������ RSS ����� id ������� VK
      $rss = "https://vkapi.ga/functional/vk2rss/rss.php?access_token=7e34d1f0146b636911112acf9b1ec307408a99a42064a17082b0387966f640168c21335aae99d9eaeb70d&id=grecha_team&count=10&include=%23memes%40grecha_team&exclude="; 
      
      // ���������� RSS ����� VK � ���������� $page ���� ������� 
      $page = file_get_contents($rss); 
      
      // ����� ����� ������ ��������� ������ ����������� (��� � ���� ������) 
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
		
      //���������� ������������ RSS ����� 
      echo $newpage; //����� 
    ?> 