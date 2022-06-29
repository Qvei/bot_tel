
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>DB search and xls create</title>
        
<link rel="stylesheet" href="/css/allz.css">
  </head>
    <body class="sb-nav-fixed">
      <header>
        
      </header>
     <main style="padding-top: 100px;">
          <strong style="margin:15px 7px 20px 7px;">Host: localhost, dbname: f0580468_kvadro, username: f0580468_test, password: test</strong>
                
                    <div class="container-fluid px-4">
                        <div class="row">
                          <div>
                            <input class="localhost d" type="text" placeholder="host">
                            <input class="dbname d" type="text" placeholder="dbname">
                            <input class="username d" type="text" placeholder="username">
                            <input class="pas d" type="text" placeholder="password">
                            <button class="basego">base</button>

                            

                            <h3 class="h3" style="margin:20px 15px 10px 15px;">Select DB table</h3>
                            <select id="tabll" name="sx" class="sx sel">
                             <option>Enter your DB params first</option>
                            
                            </select>
                            
                          </div>
                    
                        <div class="grid-container">
                        <div class="grid-item">
                        <div>
                            <h4 class="ccc">Select table columns and values (You can select multiple cols and values, to delete just click on it)</h4>
                            <select style="width: 100%;" id="clx" name="clx" class="clx sel"></select>
                            <table style="margin:20px 0 20px 13px;" class="onss2"></table>
                            
                              
                            <select style="width: 100%;" id="ss" name="ss" class="ss sel"></select>
                            
                        </div>
                        <table style="margin:20px 0 20px 13px;" class="onss1"></table>
                        </div>
                  
                        </div>
                        
                        <div style="width:100%;" class="card mb-4">
                            <div class="card-header tabbl">
                                
                            </div>
                            <div style="overflow-y: auto;width: 100%;" class="card-body" id="client"></div>
                            
                    </div>
                    </div>
                    </div>
                </main>
                
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span id="ca" class="close">&times;</span>
            <hr>
            <div class="btn-group" role="group" aria-label="Basic example" style="width: 50%;">
              <button type="button" class="btn btn-secondary rus">eng</button>
              <button type="button" class="btn btn-secondary ukr">укр</button>
            </div>
            <p class="instruction"></p>
          </div>
        </div>
         <div id="myModal2" class="modal">
          <div class="modal-content">
            <span id="za" class="close">&times;</span>
            <hr>
            <h2>XML Сформовано!</h2>
            
          </div>
        </div>
        
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="/public/js/scripts.js"></script>
  
    </body>
</html>
