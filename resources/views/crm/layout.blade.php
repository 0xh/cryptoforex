<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <!-- SEO Meta -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="/crmd2/style/main.css">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script>
        window.animationTime = 256;
        window.onloads = [];
        var currency = {
            data:{},
            value: function(a,c){
                var symb = (c=='' || this.data[c] == undefined)?'':this.data[c].unicode,sign = (parseFloat(a)<0)?'-':'',val = Math.abs(parseFloat(a));

                return sign+symb+val.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            },
            image:function(c){
                return (c=='' || this.data[c] == undefined)?'':this.data[c].image;
            }
        };
        @if(isset($currencies))
            @foreach($currencies as $currency)
                currency.data["{{$currency->code}}"]={
                    id:{{$currency->id}},
                    symbol:'{{$currency->symbol}}',
                    unicode:'{{$currency->unicode}}',
                    image:'{{$currency->image}}'
                };
            @endforeach
        @endif
    </script>
</head>
<body>
  
  <header class="header">
      <div class="container flex">
        <div class="logo">
          <a href="/">
            <img src="images/logo_x.png" alt="">
          </a>
        </div>
        <div class="search">
          <form action="#">
            <input type="search" name="search" placeholder="Поиск инструментов. Например: LTE или Litecoin">
          </form>
        </div>
        @if (Auth::guest())
          <a class="out" href="{{ url('/login') }}">Login</a>
          <a class="out" href="{{ url('/register') }}">Register</a>
        @else
          <div class="akk flex">
            <div class="item">
              <nav class="nav">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <p class="menu">Имя аккаунта</p>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="out"><i class="ic prof_out"></i>Log out</a>
                    <!-- <a href="#"><i class="ic prof_out"></i>выход</a>
                <!-- <ul class="flex column hidden">
                  <div class="top br flex">
                    <p class="active">Демо счет</p>
                    <div>
                      <input type="checkbox" class="checkbox" id="checkbox" />
                      <label for="checkbox"></label>
                    </div>
                    <p>Реальный счет</p>
                  </div>
                  <div class="br">
                    <li><a href="#" class="bal"><i class="ic in"></i>Пополнить счет</a></li>
                    <li><a href="#" class="bal2"><i class="ic out"></i>Вывод средств</a></li>
                    <li><a href="#" class="his"><i class="ic ic_his"></i>История платежей</a></li>
                  </div>
                  <div class="br">
                    <li><a href="#" class="cab"><i class="ic prof"></i>Управление профилем</a></li>
                  </div>
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="out"><i class="ic prof_out"></i>Log out</a>
                    <!-- <a href="#"><i class="ic prof_out"></i>выход</a></li> -->
                <!--</ul> -->
              </nav>
              <!-- <div class="inner flex">
                <span class="demo">Демо счет</span>
                <span class="money">10 000 $</span>
              </div> -->
            </div>
            <div class="item">
              <a href="#" class="mail"></a>
            </div>
            <div class="notifications hidden">
              <div class="top flex">
                <p>Уведомления</p>
                <div class="arrow">
                  <a href="#" class="left"></a>
                  <a href="#" class="right"></a>
                </div>
              </div>
              <ul>
                <li class="active">
                  <a href="#">
                    Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                  </a>
                </li>
                <li>
                  <a href="#">
                    Закрытие позиций по биткойну и лайткойну
                  </a>
                </li>
                <li>
                  <a href="#">
                    Изменение торгового времени 28 августа по Z (FTSE) в связи с летними банковскими выходными в Великобритании
                  </a>
                </li>
                <li>
                  <a href="#">
                    Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                  </a>
                </li>
                <li>
                  <a href="#">
                    13 августа переход на летнее время в Чили
                  </a>
                </li>
                <li>
                  <a href="#">
                    Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                  </a>
                </li>
                <li>
                  <a href="#">
                    13 августа переход на летнее время в Чили
                  </a>
                </li>
              </ul>
            </div>
            <div class="lang">
              <ul>
                <li class="active">
                  <a href="#"><img src="images/flag-eng.png" alt=""></a>
                </li>
                <li>
                  <a href="#"><img src="images/flag-arab.png" alt=""></a>
                </li>
                <li>
                  <a href="#"><img src="images/flag-eng.png" alt=""></a>
                </li>
                <li>
                  <a href="#"><img src="images/flag-arab.png" alt=""></a>
                </li>
              </ul>
            </div>
          </div>
        @endif
        </div>
    </header>

    <!-- <header class="header">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/' )}}"><img src="/images/logo.png" alt=""></a>
            </div>
            @if (Auth::guest())
                <a class="out" href="{{ url('/login') }}">Login</a>
                <a class="out" href="{{ url('/register') }}">Register</a>
            @else
                <nav class="nav">
                    <ul>
                        <li class="active">
                          <a href="#">Tasks</a>
                          <span>22</span>
                      </li>
                        <li class="active">
                          <a href="#" id="notifications">Notifications</a>
                          <span>34</span>
                          <div class="sub-item popup notifications">
                              <table>
                                  <thead>
                                      <tr>
                                          <td>Time</td>
                                          <td>Customer</td>
                                          <td>Action</td>
                                          <td>Manager</td>
                                          <td><a href="#">Close all</a></td>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>05.21.17 10:35</td>
                                          <td>Tommy Michael Josefsson</td>
                                          <td>Registred new account</td>
                                          <td>Stephen Masterson</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.21.17 09:42</td>
                                          <td>Tommy Michael Josefsson</td>
                                          <td>Inveseted $10 000.00</td>
                                          <td>Stephen Masterson</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.21.17 07:15</td>
                                          <td>Tommy Michael Josefsson</td>
                                          <td>Bought Diamond Ref. 107184914 - $135</td>
                                          <td>Stephen Masterson</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.21.17 03:35</td>
                                          <td>Tommy Michael Josefsson</td>
                                          <td>Put in Sell Diamond Ref. 107184914</td>
                                          <td>Stephen Masterson</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.21.17 00.17</td>
                                          <td>Tommy Michael Josefsson</td>
                                          <td>Sold Diamond Ref: 107184914 - $155</td>
                                          <td>Stephen Masterson</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 23.56</td>
                                          <td>Piere Ostberg</td>
                                          <td>Invested $2 500.00</td>
                                          <td>Sara Alwakel</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 20.21</td>
                                          <td>Piere Ostberg</td>
                                          <td>Bought Diamond Ref. 107184914 - $155</td>
                                          <td>Sara Alwakel</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 17.53</td>
                                          <td>Piere Ostberg</td>
                                          <td>Put on delivery Diamond Ref. 107184914</td>
                                          <td>Sara Alwakel</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 15.23</td>
                                          <td>Abdalla Alhashimi</td>
                                          <td>Logged in</td>
                                          <td>Fred Collins</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 13.27</td>
                                          <td>Abdalla Alhashimi</td>
                                          <td>Invested $2 500.00</td>
                                          <td>Fred Collins</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 10.59</td>
                                          <td>Abdalla Alhashimi</td>
                                          <td>bought Diamond Ref.  107184914 - $155</td>
                                          <td>Fred Collins</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                      <tr>
                                          <td>05.20.17 07.22</td>
                                          <td>Piere Ostberg</td>
                                          <td>Bought Diamonds Ref. 116652056</td>
                                          <td>Sara Alwakel</td>
                                          <td><a href="#">Close</a></td>
                                      </tr>
                                  </tbody>
                              </table>
                              <div class="pagination">
                                  <ul class="pagination-list">
                                      <li class="pagination-list--item first">
                                          <a href="#">First page</a>
                                      </li>
                                      <li class="pagination-list--item prev">
                                          <a href="#">...</a>
                                      </li>
                                      <li class="pagination-list--item">
                                          <a href="#">3</a>
                                      </li>
                                      <li class="pagination-list--item">
                                          <a href="#">4</a>
                                      </li>
                                      <li class="pagination-list--item">
                                          <a href="#">5</a>
                                      </li>
                                      <li class="pagination-list--item active">
                                          <a href="#">6</a>
                                      </li>
                                      <li class="pagination-list--item">
                                          <a href="#">7</a>
                                      </li>
                                      <li class="pagination-list--item next">
                                          <a href="#">...</a>
                                      </li>
                                      <li class="pagination-list--item last">
                                          <a href="#">Last page</a>
                                      </li>
                                  </ul>
                                  <div class="total_item">
                                      <span>5</span>/<span>57</span>
                                  </div>
                              </div>
                          </div>
                      </li>
                    </ul>
                </nav>
                <div class="user_in"><p>{{Auth::user()->name}} {{Auth::user()->surname}}</p></div>
                <div class="header__date">
                    <p class="date">May 28, 2017</p>
                    <p class="time">15:50</p>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="out">Log out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            @endif
      </div>
  </header> -->
  <main class="main">
      <div class="container">

          <div class="content">
              @yield('content')
        </div>
      </div>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="item flex">
        <p>"Xcryptex LTD, London, UK. VAT 000000000"</p>
        <div class="copyright">
          <p>Xcryptex LTD Copyright 2017 ©</p>
        </div>
      </div>
    </div>
  </footer>



  <div class="popup manage">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>Manage Dashborad diamonds</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Offer ID</td>
                  <td>Ref.</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Lab</td>
                  <td>Price $</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td></td>
                  <td></td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>GIA</td>
                  <td>12821.9</td>
                  <td>Status</td>
                  <td>Hold</td>
                  <td><a href="#" class="edit">Edit</a></td>
                  <td><a href="#" class="del">Del</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup users">
      <strong>Users Verified</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Date</td>
                  <td>User ID</td>
                  <td>Name</td>
                  <td>Surname</td>
                  <td>Documents</td>
                  <td>Verification</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
              <tr>
                  <td>22-05-17 19:27:52</td>
                  <td>375</td>
                  <td>George</td>
                  <td>Washington</td>
                  <td>Passport / Driver licence</td>
                  <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup users_balances">
      <strong>Users Balances</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Date</td>
                  <td>User ID</td>
                  <td>Name</td>
                  <td>Surname</td>
                  <td>Action</td>
                  <td>Value</td>
                  <td>Method</td>
                  <td></td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
                  <td><a href="#"></a><a href="#"></a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup user_history">
      <strong>Users History</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Date</td>
                  <td>User ID</td>
                  <td>Name</td>
                  <td>Surname</td>
                  <td>Action</td>
                  <td>Value</td>
                  <td>Method</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
              <tr>
                  <td>22-05-17 18:44:27</td>
                  <td>237</td>
                  <td>Samuel</td>
                  <td>L. Jacson</td>
                  <td>Deposite</td>
                  <td>$70 375.29</td>
                  <td>Deposite from Cradit Card</td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup leads">
      <div class="search">
          <form action="#">
              <input type="search" placeholder="Search">
              <button type="submit"></button>
              <a href="#" class="source">Source</a>
              <div class="popup popup_source">
                  <input type="radio" name="radio" value="All"> All<br>
                  <input type="radio" name="radio" value="1A"> 1A<br>
                  <input type="radio" name="radio" value="2A"> 2A<br>
                  <input type="radio" name="radio" value="19AGNS"> 19AGNS<br>
                  <input type="radio" name="radio" value="3A"> 3A<br>
                  <input type="radio" name="radio" value="4A"> 4A<br>
                  <input type="radio" name="radio" value="5A"> 5A<br>
                  <input type="radio" name="radio" value="6A"> 6A<br>
                  <input type="radio" name="radio" value="7A"> 7A<br>
                  <input type="radio" name="radio" value="8A"> 8A<br>
                  <input type="radio" name="radio" value="9A"> 9A<br>
                  <input type="radio" name="radio" value="10A"> 10A<br>
                  <input type="radio" name="radio" value="11A"> 11A<br>
                  <input type="radio" name="radio" value="12A"> 12A<br>
                  <input type="radio" name="radio" value="13A"> 13A<br>
                  <input type="radio" name="radio" value="14A"> 14A<br>
                  <input type="radio" name="radio" value="15A"> 15A<br>
                  <input type="radio" name="radio" value="16A"> 16A<br>
                  <input type="radio" name="radio" value="17A"> 17A<br>
                  <input type="radio" name="radio" value="18A"> 18A<br>
                  <input type="radio" name="radio" value="19A"> 19A<br>
                  <input type="radio" name="radio" value="Wadea PPC"> Wadea PPC<br>
                  <input type="radio" name="radio" value="200417SA"> 200417SA<br>
                  <input type="radio" name="radio" value="Depo"> Depo<br>
                  <input type="radio" name="radio" value="Depo"> Depo<br>
                  <input type="radio" name="radio" value="Diamond Previlege"> Diamond Previlege<br>
                  <input type="radio" name="radio" value="Yasha"> Yasha<br>
                  <input type="radio" name="radio" value="L18_05_17D"> L18_05_17D<br>
                  <input type="radio" name="radio" value="One more serch source"> One more serch source<br>
              </div>
              <a href="#" class="filter">Show filter</a>
              <div class="popup popup_filter">
                  <input type="radio" name="radio" value="All"> All<br>
                  <input type="radio" name="radio" value="New client"> New client<br>
                  <input type="radio" name="radio" value="No answer 1"> No answer 1<br>
                  <input type="radio" name="radio" value="No answer 1"> No answer 1<br>
                  <input type="radio" name="radio" value="No answer 3"> No answer 3<br>
                  <input type="radio" name="radio" value="Call back"> Call back<br>
                  <input type="radio" name="radio" value="Not interested"> Not interested<br>
                  <input type="radio" name="radio" value="Call back / No answer"> Call back / No answer<br>
                  <input type="radio" name="radio" value="Wrong number"> Wrong number<br>
                  <input type="radio" name="radio" value="Wrong number"> Wrong number
              </div>
              <select name="admin" id="admin">
                  <option value="none-disable">Choose Admin</option>
                  <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                  <option value="Fred Collins">Fred Collins</option>
                  <option value="Test admin">Test admin</option>
                  <option value="One more admin">One more admin</option>
                  <option value="New one admin">New one admin</option>
                  <option value="Chosen admin">Chosen admin</option>
                  <option value="Stephen Masterson">Stephen Masterson</option>
                  <option value="Thomas Baxter">Thomas Baxter</option>
              </select>
              <a href="#" class="filter">Cange admin</a>
              <a href="#" class="del">Delete leads</a>
              <a href="#" class="new" id="edit_user">Add user</a>
          </form>
      </div>
      <strong>Leads</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td><div class="serch"></div>ID <div class="arrow"><span></span><span></span></div></td>
                  <td>Created <div class="arrow"><span></span><span></span></div></td>
                  <td>Customers name <div class="arrow"><span></span><span></span></div></td>
                  <td>E-mail <div class="arrow"><span></span><span></span></div></td>
                  <td>Phone <div class="arrow"><span></span><span></span></div></td>
                  <td>Country <div class="arrow"><span></span><span></span></div></td>
                  <td>Source <div class="arrow"><span></span><span></span></div></td>
                  <td>Source Descr. <div class="arrow"><span></span><span></span></div></td>
                  <td>Status <div class="arrow"><span></span><span></span></div></td>
                  <td>Admin <div class="arrow"><span></span><span></span></div></td>
                  <td></td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
              <tr>
                  <td><div class="serch"></div>725</td>
                  <td>10-04-17 16:39</td>
                  <td>Edgar Zinsser</td>
                  <td>Prezision@zinsser.org</td>
                  <td>497357559623</td>
                  <td>DE</td>
                  <td>200417SA</td>
                  <td>Nothing</td>
                  <td>New</td>
                  <td>Stephen Masterson</td>
                  <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup operations">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>Diamonds</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Certificate</td>
                  <td>Price</td>
                  <td>Buy</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
              <tr>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>12821.9</td>
                  <td><a href="#" class="buy">Buy</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>


  <div class="popup waiting">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>Waiting</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Hold Time</td>
                  <td>Hold Time</td>
                  <td>Buy</td>
                  <td>Cancel</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>71:27:52</td>
                  <td>5 319.86</td>
                  <td><a href="#" class="buy">Buy</a></td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup history_in-sell">
      <strong>Customers diamonds in sell / History</strong>
      <div class="offer">
          Offer ID: <span>26293</span> / Ref: <span>107184914</span> / Carat: <span>0.12</span> / Color: <span>D</span> / Clarity <span>SI3</span> / Price: <span>155$</span>
      </div>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>User ID</td>
                  <td>Mail</td>
                  <td>Name</td>
                  <td>Phone</td>
                  <td>Date</td>
                  <td>Price $</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>88</td>
                  <td>faagboola@hotmail.com</td>
                  <td>Fanla Agboola</td>
                  <td>447732527066</td>
                  <td>05/05/2017 15:55:35</td>
                  <td>88.08</td>
              </tr>
              <tr>
                  <td>88</td>
                  <td>faagboola@hotmail.com</td>
                  <td>Fanla Agboola</td>
                  <td>447732527066</td>
                  <td>05/05/2017 15:55:35</td>
                  <td>88.08</td>
              </tr>
              <tr>
                  <td>88</td>
                  <td>faagboola@hotmail.com</td>
                  <td>Fanla Agboola</td>
                  <td>447732527066</td>
                  <td>05/05/2017 15:55:35</td>
                  <td>88.08</td>
              </tr>
          </tbody>
      </table>
      <a href="#" class="back">Back this offer to offers</a>
  </div>

  <div class="popup customers">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>CustomersÃ¢â‚¬â„¢ diamonds</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Offer ID</td>
                  <td>Ref.</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Sertificate</td>
                  <td>Price $</td>
                  <td>Buyer</td>
                  <td>Manager</td>
                  <td>Sale date</td>
                  <td></td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>508897</td>
                  <td>1200022005</td>
                  <td>1.82</td>
                  <td>H</td>
                  <td>Sertificate</td>
                  <td>165</td>
                  <td>Mustafa Ali</td>
                  <td>Sara Alwakel</td>
                  <td>05-18-2017 12:48:12</td>
                  <td><a href="#">History</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup my_diamonds">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>My Diamonds</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Certificate</td>
                  <td>Date / Time</td>
                  <td>Price $</td>
                  <td>Sell</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td>04-28-2017 12:18:51</td>
                  <td class="blue">130</td>
                  <td><a href="#" class="buy">Sell</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup in_sell">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>In Sell</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Certificate</td>
                  <td>Price $</td>
                  <td>Cancel</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="disable">Waiging for buying</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="disable">Waiging for buying</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>Certificate</td>
                  <td class="blue">2 547.92</td>
                  <td><a href="#" class="red no">Cancel</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup sold_diamond">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>Sold Diamonds</strong>
      <div class="close"></div>
      <div class="results-filter">
          <form method="post" class="form-filter">
              <div class="form-filter--line">
                  <input type="radio" id="byQuantity" name="filtered-by" value="by quantity">
                  <label for="byQuantity" class="form-filter--first-column">By Quantity</label>
                  <p class="form-filter--quantity">
                      <span>Last</span>
                          <input type="radio" id="operations5" name="quantity-operations" value="5">
                      <label for="operations5" class="form-filter--quantity-value">5</label>
                          <input type="radio" id="operations10" name="quantity-operations" value="10">
                      <label for="operations10" class="form-filter--quantity-value">10</label>
                          <input type="radio" id="operations15" name="quantity-operations" value="15">
                      <label for="operations15" class="form-filter--quantity-value">15</label>
                      <span>operations</span>
                  </p>
              </div>
              <div class="form-filter--line">
                  <input type="radio" id="byPeriod" name="filtered-by" value="by period">
                  <label for="byPeriod" class="form-filter--first-column">By Period</label>
                  <p class="form-filter--period">
                      <span>Last</span>
                          <input type="radio" id="periodWeek" name="period-length" value="week">
                      <label for="periodWeek" class="form-filter--period-value">Week</label>
                          <input type="radio" id="periodMonth" name="period-length" value="month">
                      <label for="periodMonth" class="form-filter--period-value">Month</label>
                          <input type="radio" id="periodChoose" name="period-length" value="choose">
                      <label for="periodChoose" class="form-filter--period-value">Choose period</label>
                  </p>
              </div>
              <div class="form-filter--line">
                  <p class="form-filter--first-column">Period:</p>
                  <p class="form-filter--period">
                      <input type="date" name="period-length" id="periodBegin" placeholder="04.01.2017"> -
                      <input type="date" name="period-length" id="periodEnd" placeholder="05.01.2017">
                  </p>
              </div>
              <div class="form-filter--line">
                  <p class="form-filter--first-column">Amount:</p>
                  <p class="form-filter--amount">
                      <input type="number" min="0" name="amount-length" id="amountBegin" placeholder="From"> -
                      <input type="number" min="0" name="amount-length" id="amountEnd" placeholder="To">
                  </p>
              </div>
              <div class="form-filter--line">
                  <div class="form-filter--apply">
                      <input type="submit" value="Apply">
                  </div>
              </div>
          </form>
      </div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Date / Time</td>
                  <td>Price $</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
              <tr>
                  <td>120250982</td>
                  <td>0.91</td>
                  <td>G</td>
                  <td>SI1</td>
                  <td>04-12-2017 17:29:26</td>
                  <td class="blue">2 547.92</td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup cust_in-sell">
      <div class="search_all">
          <form action="#">
              <input type="search" name="search" title="search" placeholder="Search by ref. number">
              <button type="submit" class="search-submit"></button>
              <a href="#" class="advanced">Advanced search</a>
              <div class="popup popup-search">
                  <div class="item">
                      <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                      <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                  </div>
                  <div class="item">
                      <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                      <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                  </div>
                  <div class="item">
                      <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                      <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                  </div>
              </div>
          </form>
      </div>
      <strong>Customers diamonds in sell</strong>
      <div class="close"></div>
      <table>
          <thead>
              <tr>
                  <td>Ref</td>
                  <td>Carat</td>
                  <td>Color</td>
                  <td>Clarity</td>
                  <td>Sertificate</td>
                  <td>Price $</td>
                  <td>User</td>
                  <td>Manager</td>
                  <td>History</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
              <tr>
                  <td>107184914</td>
                  <td>0.12</td>
                  <td>D</td>
                  <td>SI3</td>
                  <td>-</td>
                  <td>155</td>
                  <td>Abdalla Alhashimi</td>
                  <td>Sara Alwakel</td>
                  <td><a href="#">History</a></td>
              </tr>
          </tbody>
      </table>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup_task">
      <strong class="active">Tasks <span>22</span></strong>
      <div class="close"></div>
      <ul class="top">
          <li><b>Leads Tasks</b></li>
          <li>Deadline</li>
          <li>Status</li>
          <li><b>Leads Tasks</b></li>
          <li>Deadline</li>
          <li>Status</li>
      </ul>
      <div class="all_task">
          <ul class="task">
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <ul class="sub">
                      <li>No tasks</li>
                      <li>05-25-17 14:00</li>
                      <li>
                          <a href="#" class="cancel">cancel</a>
                          <a href="#" class="complate">complate</a>
                      </li>
                  </ul>
              </li>
          </ul>
      </div>
      <div class="add_task">
          <strong>Add Task</strong>
          <form action="#">
              <textarea name="add_task" id="add_task" placeholder="Enter task text"></textarea>
              <input type="submit" value="Add task">
          </form>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup_users_balans">
      <strong>Users balances</strong>
      <div class="close"></div>
      <div class="table">
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Action</td>
                      <td>Value</td>
                      <td>Method</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Depostit ok</td>
                      <td>100</td>
                      <td>Deposit from Credit Card</td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup_email">
      <strong>Email logs</strong>
      <div class="close"></div>
      <div class="table">
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Email</td>
                      <td>Status</td>
                      <td>Check</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>praezision@zinsser.org</td>
                      <td>Email sent</td>
                      <td><a href="#" class="read">read email</a></td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup_telephone">
      <strong>Telephone</strong>
      <div class="close"></div>
      <div class="table">
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Telephone</td>
                      <td>Status</td>
                      <td>Check</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>+00000000000000</td>
                      <td>Phone call 7 min. 51 sec</td>
                      <td><a href="#" class="check">Check</a></td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup-accept">
      <h2 class="popup-accept--title">
          Are you going to <span class="accept-text hidden">buy</span> this diamond?</h2>
      <div class="popup-accept--title-line"></div>
      <h3 class="popup-accept--question">Are you sure?</h3>
      <ul class="popup-accept--info">
          <li class="info-text">Ref. <span>12042017</span></li>
          <li class="info-text">Carat <span>10</span></li>
          <li class="info-text">Color <span>F</span></li>
          <li class="info-text">Clarity <span>SI1</span></li>
          <li class="info-text">Price <br><span>$10 117.17</span></li>
      </ul>
      <div class="accept-buttons">
          <div class="button-buy" id="play"><a class="yes">Yes</a></div>
          <div class="button-cancel"><a class="no">No</a></div>
      </div>
  </div>

  <div class="popup widthdtrawal">
      <strong>Widthdtrawal investment</strong>
      <div class="close"></div>
      <div class="table">
          <span>Total: 2</span>
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Value</td>
                      <td>Status</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>27 000</td>
                      <td>Accepted</td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup popup_money_report">
      <strong>Money transaction report</strong>
      <div class="close"></div>
      <div class="search">
          <form action="#">
              <input type="search" placeholder="search" name="search">
              <input type="date" value="Date min">
              <input type="date" value="Date max">
              <select name="processes" id="processes">
                  <option value="Withdrawal processing">Withdrawal processing</option>
                  <option value="Withdrawal declined">Withdrawal declined</option>
                  <option value="Withdrawal successful">Withdrawal successful</option>
                  <option value="Deposit in processing">Deposit in processing</option>
                  <option value="Deposit declined">Deposit declined</option>
                  <option value="Deposit successful">Deposit successful</option>
              </select>
              <input type="submit" value="Search">
          </form>
      </div>
      <div class="table">
          <span>Total: 79</span>
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Admin</td>
                      <td>Action</td>
                      <td>Value</td>
                      <td>Method</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Fred Collins < Alexander Bogdanov</td>
                      <td>Withdrawal processing</td>
                      <td>27 000</td>
                      <td>Withdrawal from Credit card</td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup manage_lots">
      <strong>Manage lots</strong>
      <div class="search">
          <form action="#">
              <input type="search" placeholder="Search" name="search">
          </form>
          <a href="#" class="add">Add lot</a>
      </div>
      <div class="close"></div>
      <div class="table">
          <table>
              <thead>
                  <tr>
                      <td>ID</td>
                      <td>Ref</td>
                      <td>Carat</td>
                      <td>Color</td>
                      <td>Clarity</td>
                      <td>Price</td>
                      <td>Investing Bar Free</td>
                      <td>Time</td>
                      <td></td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
                  <tr>
                      <td>01</td>
                      <td>12042017</td>
                      <td>10</td>
                      <td>F</td>
                      <td>VS1</td>
                      <td>$30 000</td>
                      <td>98.7%</td>
                      <td>Time</td>
                      <td><a href="#" id="edit_user">Edit</a></td>
                      <td><a href="#" class="edit">Info</a></td>
                  </tr>
              </tbody>
          </table>
          <div class="pagination">
              <ul>
                  <li class="first">
                      <a href="#">First page</a>
                  </li>
                  <li class="prev">
                      <a href="#">...</a>
                  </li>
                  <li>
                      <a href="#">3</a>
                  </li>
                  <li>
                      <a href="#">4</a>
                  </li>
                  <li class="active">
                      <a href="#">5</a>
                  </li>
                  <li>
                      <a href="#">6</a>
                  </li>
                  <li>
                      <a href="#">7</a>
                  </li>
                  <li class="next">
                      <a href="#">...</a>
                  </li>
                  <li class="last">
                      <a href="#">Last page</a>
                  </li>
              </ul>
              <div class="total_item">
                  <span>5</span>/<span>57</span>
              </div>
          </div>
      </div>
  </div>

  <div class="popup customer_investments">
      <strong>Customer investments</strong>
      <div class="close"></div>
      <div class="table">
          <table>
              <thead>
                  <tr>
                      <td>Date</td>
                      <td>User ID</td>
                      <td>Name</td>
                      <td>Lots</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
                  <tr>
                      <td>2017-05-29 14:42:33</td>
                      <td>27</td>
                      <td>NIYUNGEKO Gerard</td>
                      <td>Lot 1 <span></span> $3 500</td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div>

  <div class="popup import_leads">
      <strong>Import leads</strong>
      <div class="close"></div>
      <div class="item_wrap">
          <form action="#">
              <input type="file" value="Choose file">
              <input type="submit" value="Import">
          </form>
          <p>Format xls: Name, Surname, email, phone number, country, source, source description</p>
          <p>Required fields name and phone or mail</p>
      </div>
  </div>

  <!-- <div class="popup new_user">
      <strong>New Users</strong>
      <div class="close"></div>
      <div class="search">
          <form action="#">
              <select name="affiliate" id="affiliate">
                  <option value="Select Affiliate">Select Affiliate</option>
                  <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                  <option value="Jessica Alba">Jessica Alba</option>
                  <option value="Christopher Lambert">Christopher Lambert</option>
                  <option value="Jonny Dep">Jonny Dep</option>
              </select>
              <select name="source" id="source">
                  <option value="Select Source">Select Source</option>
                  <option value="Diamonds-marketing.com">Diamonds-marketing.com</option>
              </select>
              <select name="country" id="country">
                  <option value="Select Country">Select Country</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
              </select>
              <select name="admin" id="admin">
                  <option value="Select Admin">Select Admin</option>
                  <option value="Collins Fred">Collins Fred</option>
                  <option value="James Bond">James Bond</option>
                  <option value="Ashley Cooper">Ashley Cooper</option>
                  <option value="New guy">New guy</option>
              </select>
              <input type="submit" value="Change admin">
          </form>
      </div>
      <div class="table">
          <span>Total: 4</span>
          <table>
              <thead>
                  <tr>
                      <td></td>
                      <td>ID</td>
                      <td>Registration</td>
                      <td>Mail</td>
                      <td>Name</td>
                      <td>Phone</td>
                      <td>Country</td>
                      <td>Balance</td>
                      <td>IP</td>
                      <td>Source</td>
                      <td>Affiliate</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td></td>
                      <td>161</td>
                      <td>2017-05-11 17:58:55</td>
                      <td>focinabup@alienware13.com</td>
                      <td>My Diamonds</td>
                      <td>+0000000000</td>
                      <td>Argentina</td>
                      <td>$37 512.27</td>
                      <td>37.142.168.151</td>
                      <td>diamonds-marketing.com</td>
                      <td>
                          <a href="#" id="edit_user">Edit</a>
                          <a href="#" class="edit">Info</a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>161</td>
                      <td>2017-05-11 17:58:55</td>
                      <td>focinabup@alienware13.com</td>
                      <td>My Diamonds</td>
                      <td>+0000000000</td>
                      <td>Argentina</td>
                      <td>$37 512.27</td>
                      <td>37.142.168.151</td>
                      <td>diamonds-marketing.com</td>
                      <td>
                          <a href="#" id="edit_user">Edit</a>
                          <a href="#" class="edit">Info</a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>161</td>
                      <td>2017-05-11 17:58:55</td>
                      <td>focinabup@alienware13.com</td>
                      <td>My Diamonds</td>
                      <td>+0000000000</td>
                      <td>Argentina</td>
                      <td>$37 512.27</td>
                      <td>37.142.168.151</td>
                      <td>diamonds-marketing.com</td>
                      <td>
                          <a href="#" id="edit_user">Edit</a>
                          <a href="#" class="edit">Info</a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>161</td>
                      <td>2017-05-11 17:58:55</td>
                      <td>focinabup@alienware13.com</td>
                      <td>My Diamonds</td>
                      <td>+0000000000</td>
                      <td>Argentina</td>
                      <td>$37 512.27</td>
                      <td>37.142.168.151</td>
                      <td>diamonds-marketing.com</td>
                      <td>
                          <a href="#" id="edit_user">Edit</a>
                          <a href="#" class="edit">Info</a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="pagination">
          <ul>
              <li class="first">
                  <a href="#">First page</a>
              </li>
              <li class="prev">
                  <a href="#">...</a>
              </li>
              <li>
                  <a href="#">3</a>
              </li>
              <li>
                  <a href="#">4</a>
              </li>
              <li class="active">
                  <a href="#">5</a>
              </li>
              <li>
                  <a href="#">6</a>
              </li>
              <li>
                  <a href="#">7</a>
              </li>
              <li class="next">
                  <a href="#">...</a>
              </li>
              <li class="last">
                  <a href="#">Last page</a>
              </li>
          </ul>
          <div class="total_item">
              <span>5</span>/<span>57</span>
          </div>
      </div>
  </div> -->

  <div class="bgc"></div>

  <?php @include('crm.popup') ?>
  <!-- Script-->
  <!--  Vendor amCharts -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="http://aplicant.good-point.ru/alfa-diamonds/js/jquery.shapeshift-master/core/jquery.shapeshift.min.js"></script>
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script src="https://www.amcharts.com/lib/3/amstock.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="/crmd2/js/main.js"></script>
  <script src="/crmd2/js/main_new.js"></script>
  <script src="/crmd2/js/i.js"></script>
  <!-- <script src="/crmd2/js/jquery.shapeshift.min.js"></script> -->
  <script src="{{ asset('js/loader.js') }}"></script>
  <script src="{{ asset('js/cryptofx.fn.js') }}"></script>

</body>
</html>
