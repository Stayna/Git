    <?php 
    // ������� v0.1 by Jinnd 08.03.2019 
    // 57846937 - id ������� ��� (��� �������) 
      $vk =''; // ��������� ��������� ������ �������� 
      
      // ��������� �������� �� �������� ������� id ������� vk � �������� �� �� ��������   
      if(isset($_GET['vk']) and is_numeric($_GET['vk'])){     
        $vk = $_GET['vk']; // ���� ������ , �� ����������� id ���������� $vk 
      } 
      else { 
        //����� ����� ��������� �� ������ � ���������������� ���������� �������    
        echo "�� �� ������ id ������� � ������ ������� ����� ���������� 'vk' !";    exit(); 
      } 
      
      // ����� ����������� ������ ������������ RSS ����� id ������� VK
      $rss = "https://vkapi.ga/functional/vk2rss/rss.php?access_token=a319f4f47e29e33ef9572976472fd33e6ec82c642f4b395ccbd2ecf76905cd6bf9e8b301c96610b5c0b6f&id=public" . $vk . "&count=10&include=&exclude="; 
      
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