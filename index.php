<?php
  $country = isset($_GET['country']) ? htmlspecialchars($_GET['country']) : "Vietnam";
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://corona.lmao.ninja/countries",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
  ));
  $get = curl_exec($curl);
  curl_close($curl);
  $decode = json_decode($get,JSON_UNESCAPED_UNICODE);

  $check = true; $i = 0;
  while ($check == true) {
    if (ucwords($decode[$i]["country"]) == ucwords($country)) {
      $cases = $decode[$i]["cases"];
      $todayCases = $decode[$i]["todayCases"];
      $deaths = $decode[$i]["deaths"];
      $todayDeaths = $decode[$i]["todayDeaths"];
      $recovered = $decode[$i]["recovered"];
      $critical = $decode[$i]["critical"];
      $check = false;
    }else $i++;
  }
//
echo '{"messages": [
  						{"text": "Cập nhật tình hình hiện tại ở '.ucwords($country).' \n - Tổng số ca: ' . $todayCases . ' \n - Số ca hôm nay: '.$todayCases.' \n - Số người ra đi: ' . $deaths . ' \n - Số người ra đi hôm nay: ' . $todayDeaths . ' \n - Đã bình phục: ' . $recovered . ' \n - Nguy kịch: ' . $critical.'"}
  						]}';
