<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stamp</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80vh;
      margin: 0;
    }
    .stamp {
      width: 281px;
      height: 150px;
      border: 3px solid #000;
      border-radius: 5px;
      padding: 14px;
      font-family: Arial, sans-serif;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
     
    }

    .title {
      text-align: center;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .content {
      text-align: left;
      margin-top: 15px;
      font-weight: bold;
    }

    .name, .date {
      margin: 0;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    .date {
      margin-top: 5px;
    }
    .text{
        color: #cd1515;
    }
  </style>
</head>
<body>

<div class="stamp">
  <div class="title"> <span style="font-size: 14px;">CONSULAT GENERAL HONORAIRE DU BENIN AU CONGO </span><br>
    VU POUR LEGALISATION DE LA <br> SIGNATURE DE
</div>
  <div class="content">
    <div class="name">
        M:...<span class="text">{{$data->surname}}</span>
     </div>
    <div class="name">
       N°:.......<span class="text">
            @if(strlen($id) == 1)
                {{ str_pad($id, 3, '0', STR_PAD_LEFT) }}
            @elseif(strlen($id) == 2)
                {{ str_pad($id, 3, '0', STR_PAD_LEFT) }}
            @else
                {{ $id }}
            @endif
           /LEG/CGHBC/PN</span>..............
    </div>
    <div class="date">
       Pointe-Noire, le: ........<span class="text">{{date("d/m/Y", strtotime(Date('d-m-Y')))}}</span>........
    </div>
  </div>
</div>

</body>
</html>