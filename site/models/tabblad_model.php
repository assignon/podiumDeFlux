<?php

require "../vrijwilliger/site/core/model.php";

class tabblad extends model
{


        public function __construct()
        {

           parent::__construct();

        }


        public function getUser_data($user_id)
       {

         $select = $this->prepare("SELECT*FROM signin WHERE id=?",array($user_id));
         $data_fetch = $select->fetch();
         return $data_fetch;

       }


       public function displayTabs()
       {

          $selectTab = $this->PDO()->query("SELECT * FROM tabs");

          while($display = $selectTab->fetch())
          {

             ?>

                <div class="all_tabs">

                   <h4 class="tabsname"><?php echo $display['tab_name'];?></h4>

                </div>

                <script type="text/javascript">

                   window.addEventListener('load', function(){

                       var tabCore = document.querySelector(".tabCore");
                       var all_tabs = document.querySelectorAll('.all_tabs');

                       for (var i = 0; i < all_tabs.length; i++) {

                          var all_tabsArr = all_tabs[i];
                          tabCore.appendChild(all_tabsArr);

                       }

                   })

                </script>

             <?php

          }

       }





       public function tab()
       {

          if(isset($_GET['tab']) AND !empty($_GET['tab']))
          {

             $tab_name = htmlentities(htmlspecialchars($_GET['tab']));

          }

           ?>

              <script type="text/javascript">

                  window.addEventListener("load", function(){

                      $(function(){


                          var xhr;


                          if (window.XMLHttpRequest) {
                               // code for IE7+, Firefox, Chrome, Opera, Safari
                                xhr = new XMLHttpRequest();
                              } else {
                               // code for IE6, IE5
                                 xhr = new ActiveXObject("Microsoft.XMLHTTP");
                             }

                           var error = document.querySelector(".tabsFront .error");
                           var newTab = document.getElementById("newTab");
                           var allTabs = document.getElementById("allTabs");
                           var tabContent = document.getElementById("tabContent");
                           var pdf_name = document.getElementById("pdf_name");
                           var addTabs = document.getElementById("addTabs");
                           var updateTabs = document.getElementById("updateTabs");

                          // var tabName = "<?php //echo $tab_name;?>";

                           addTabs.addEventListener("click", addTab);
                           updateTabs.addEventListener("click", updateTab);

                           function addTab(e)
                           {

                                e.preventDefault();

                                var newTabVal = newTab.value;
                                var tabContentVal = $(tabContent).val();
                                var pdfname = pdf_name.value;
                                var pdf = document.getElementById('pdf');
                                var pdfFile = pdf.files[0];
                                var formData = new FormData();
                                formData.append('pdf', pdfFile);

                                xhr.onreadystatechange = function() {
                                    if(this.readyState == 4 && this.status == 200) {

                                             error.innerHTML = xhr.responseText;

                                             if(error.textContent == "Tabblad met succes toegevoegd...")
                                             {

                                                 newTab.value = "";
                                                 tabContentVal.value = "";

                                                 $(".tabsFormContainer").css("opacity","0");
                                                 $(".tabsFormContainer").hide("slow");

                                                 //displaytabsPdf();
                                                 //getAllTab();

                                             }

                                       }

                                  };


                                 if(newTabVal != "" && tabContentVal != "")
                                 {

                                   xhr.open('POST','../vrijwilliger/site/models/ajax_requests/tabs/addTab.php?newTabVal='+newTabVal+'&tabContentVal='+tabContentVal+'&pdfname='+pdfname,true);
                                   xhr.send(formData);

                                 }else{

                                    error.innerHTML = "Geef een naam aan de nieuwe tabblad en aan de pdf bestaande...";

                                 }


                           }


                           var all_tabs = document.querySelectorAll('.all_tabs');

                           for (var i = 0; i < all_tabs.length; i++) {

                              var all_tabsArr = all_tabs[i];
                              all_tabsArr.addEventListener('click', function(e){

                                var tabName;


                                $('.tabblads').css('opacity','1');
                                $('.tabblads').show('slow');


                                if(e.target.className == 'all_tabs')
                                {

                                   tabName = e.target.childNodes[1].textContent;

                                }else{

                                  tabName = e.target.textContent;

                                }

                                    displaytabsPdf(tabName);

                              });

                           }




                           function selectTab()
                           {

                                var tabblads = document.querySelector(".tabblads select")
                                tabblads.addEventListener('change', function(e){

                                    var tabname = e.target.value;
                                    displaytabsPdf(tabname);

                                })


                           }
                           selectTab();




                           function displaytabsPdf(tabName)
                           {

                               var tabCore = document.querySelector(".tabContainer .tabCore");


                               xhr.onreadystatechange = function() {
                                   if(this.readyState == 4 && this.status == 200) {

                                           tabCore.innerHTML = xhr.responseText;
                                           displayPdf(tabName);

                                           //$(".pdf_name").click(displaytabsPdfContent);

                                      }

                                 };



                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/displayTabName.php?tabName='+tabName,true);
                                  xhr.send();

                           }





                           function displayPdf(tabName)
                           {

                               var pdfsContainer = document.querySelector(".tabContainer .pdfsContainer");

                               xhr.onreadystatechange = function() {
                                   if(this.readyState == 4 && this.status == 200) {

                                           $(pdfsContainer).show();
                                           $(pdfsContainer).css('opacity','1');
                                           $('.tabCore').css('width','80%');
                                           pdfsContainer.innerHTML += xhr.responseText;

                                           $(".pdf_name").click(displaytabsPdfContent);

                                           pdfMobile(pdfsContainer);

                                      }

                                 };



                                  xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/displayPdfs.php?tabName='+tabName,true);
                                  xhr.send();

                           }



                           function pdfMobile(pdfsContainer)
                           {

                              var windowWidth = window.innerWidth;

                              if(windowWidth <= 800)
                              {

                                 $(pdfsContainer).hide('slow');

                              }else if(windowWidth > 800){

                                 $(pdfsContainer).show('slow');

                              }

                              window.addEventListener('resize', function(){

                                  var windowWidth = window.innerWidth;

                                  if(windowWidth <= 800)
                                  {

                                     $(pdfsContainer).hide('slow');

                                  }else if(windowWidth > 800){

                                     $(pdfsContainer).show('slow');

                                  }


                              })


                              $("#closePdfContainer").click(function(){

                                 $(".pdfsContainer").hide('slow');

                              })

                           }




                            var allTabs = document.getElementById("allTabs");
                            allTabs.addEventListener("change", getChoosedTab_value);

                            function getChoosedTab_value(e)
                            {

                                  var allTabsVal = e.target.value;
                                  var allTabsVal = e.target.value;
                                  var tabContent = document.getElementById("tabContent");
                                   var updateTextArea = document.querySelector(".updateTextArea");
                                //  var updateTextArea = document.querySelector(".updateTextArea");

                                  if(allTabsVal.value != "Selecteer een tabblad die u wil aanpassen")
                                  {
                                       //var tab_Content = $("#tabContent").val();
                                       var updateContent = document.querySelector("#updateContent");

                                        xhr.onreadystatechange = function() {
                                            if(this.readyState == 4 && this.status == 200) {

                                                  updateTextArea.innerHTML = xhr.responseText;
                                                  $(".ckeditor").ckeditor();
                                                //  $(".updateTextArea").css("margin-top","-458px");

                                                //  var tab_Content = document.querySelector(".ckeditor");

                                                  //updateTab(allTabsVal, tab_Content);

                                               }

                                          };


                                           xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/getTabValue.php?allTabsVal='+allTabsVal,true);
                                           xhr.send();

                                  }

                            }



                           function updateTab()
                           {

                                var updateTabs = document.getElementById("updateTabs");
                                var error = document.querySelector(".tabsFront .error");

                                updateTabs.addEventListener("click", function(e){

                                    e.preventDefault();

                                    //var allTabsVal = e.target.parentNode.childNodes[13].value;
                                    var allTabs = document.getElementById('allTabs');

                                    if(allTabs.value != "Selecteer de tabblad die aangepast moet worden")
                                    {

                                        //  var tab_Content = document.querySelector(".ckeditor");
                                          var tabContentVal = $(".ckeditor").val();
                                          var tabName = $("#newTab").val();
                                          var pdfName = $("#pdf_nameUpdate").val();
                                          var currentPdf = $(".pdfsName").val();
                                          var allTabsVal = allTabs.value;

                                          var pdf = document.getElementById('pdf');
                                          var pdfFile = pdf.files[0];
                                          var formData = new FormData();
                                          formData.append('pdf', pdfFile);

                                        xhr.onreadystatechange = function() {
                                             if(this.readyState == 4 && this.status == 200) {

                                                     error.innerHTML = xhr.responseText;

                                                     if(error.textContent == "tabblad met succes aangepast...")
                                                     {

                                                        // displaytabsContent();
                                                         e.target.parentNode.childNodes[7].value = "Selecteer een tabblad die u wil aanpassen";
                                                         error.innerHTML = "tabblad met succes aangepast1... klik op het kruisje om terug te gaan of selecteer een andere tabblad om aan te passen...";

                                                     }

                                                }

                                           };


                                            xhr.open('POST','../vrijwilliger/site/models/ajax_requests/tabs/updateTab.php?tabName='+allTabsVal+'&tab_Content='+tabContentVal+'&tabnameUpdate='+tabName+'&pdf_name='+pdfName+'&currentPdf='+currentPdf,true);
                                            xhr.send(formData);

                                    }else{

                                        error.innerHTML = "Selecteer een tabblad...";

                                    }


                                })

                           }
                           updateTab();


                           $("#deleteTabs").click(deleteTabs);
                           function deleteTabs(e)
                           {

                              e.preventDefault();
                              var pdfsName = document.querySelector('.pdfsName');
                              var allTabs = document.getElementById('allTabs');
                              var error = document.querySelector(".tabsFront .error")
                              var tabPass = document.getElementById("tabPass");

                              if(allTabs.value != "Selecteer de tabblad die aangepast moet worden" || pdfsName.value != "Selecteer een pdf" && tabPass.value == "")
                              {

                                 var pdfsNameVal = pdfsName.value;
                                 var allTabsVal = allTabs.value;
                                 var tabPassVal = tabPass.value;

                                 xhr.onreadystatechange = function() {
                                      if(this.readyState == 4 && this.status == 200) {

                                          error.innerHTML = xhr.responseText;

                                         }

                                    };


                                     xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/deleteTab.php?pdfsName='+pdfsNameVal+'&allTabs='+allTabsVal+'&tabPassVal='+tabPassVal,true);
                                     xhr.send();

                              }else{

                                error.innerHTML = "Selecteer een tabbladof een pdf...";

                              }

                           }



                           function displaytabsPdfContent(e)// geroepen vanaf addTab()
                           {

                                 var core = document.querySelector(".tabContainer #core");
                                 var currentPdf = e.target.textContent;

                                 xhr.onreadystatechange = function() {
                                     if(this.readyState == 4 && this.status == 200) {

                                             //core.innerHTML = xhr.responseText;
                                             //getAllTab();
                                        }

                                   };



                                    xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/displayTab.php?currentPdf='+currentPdf,true);
                                    xhr.send();


                           }
                           //displaytabsContent();




                           function getAllTab()// geroepen vanaf addTab()
                           {

                              //   var tabsLink = document.querySelector(".tabsLink");
                                 var tabsReceiver = document.getElementById("tabsReceiver");

                                 xhr.onreadystatechange = function() {
                                     if(this.readyState == 4 && this.status == 200) {

                                            //tabsLink.innerHTML = xhr.responseText;
                                             tabsReceiver.innerHTML = xhr.responseText;

                                        }

                                   };



                                    xhr.open('GET','../vrijwilliger/site/models/ajax_requests/tabs/getAllTab.php',true);
                                    xhr.send();

                           }



                      })

                  })

              </script>

           <?php

       }


       public function displayAllTabs()
       {

             $selectTabs = $this->PDO()->query("SELECT tab_name FROM tabs");

             while($postTabs = $selectTabs->fetch())
             {

                ?>

                   <option value="<?php echo $postTabs['tab_name'];?>"><?php echo $postTabs['tab_name'];?></option>

                <?php

             }

       }



       public function displayAllPdfs()
       {

             $selectPdfs = $this->PDO()->query("SELECT pdf_name FROM pdfs");

             while($postPdfs = $selectPdfs->fetch())
             {

                ?>

                   <option value="<?php echo $postPdfs['pdf_name'];?>"><?php echo $postPdfs['pdf_name'];?></option>

                <?php

             }

       }

  }


?>
