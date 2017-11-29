<?php

require "../vrijwilliger/site/core/model.php";

class smoelenBoek extends model
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



       public function face_book()
       {

          ?>

            <script type="text/javascript">

              $(function(){

                window.addEventListener("load", function(){

                     var add = document.getElementById("add");
                     //add.addEventListener("click", callFaceForm);
                     var xhr;


                     if (window.XMLHttpRequest) {
                          // code for IE7+, Firefox, Chrome, Opera, Safari
                           xhr = new XMLHttpRequest();
                         } else {
                          // code for IE6, IE5
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }


                     function callFaceForm()
                     {

                         $(".faceForm").css("opacity","1");
                         $(".faceForm").show();
                         $(".error").html("Voeg afbeeldingen aan de smoelen boek toe...");

                         $("#updateImg_book").hide("slow");
                          $('#addFace_book').show("slow");
                          $('#updateFace_book').hide("slow");

                         $(".faceInputs").show();
                         $(".faceGroupUpdate").hide();
                         $(".faceInputs").show();
                         $("#selectGroup").show();
                         $("#faceImg").show();
                         $(".email").show();
                         $(".emailUpdate").hide("slow");


                         $("#closeFaceBookForm").css("bottom","100px");



                     }

                     add.addEventListener("click", callFaceForm);



                     function hideFaceForm()
                     {


                         $(".faceForm").hide("slow");
                         $(".faceForm").css("opacity","0");

                     }



                     function callGroupUpdateForm()
                     {

                         $(".faceForm").css("opacity","1");
                         $(".faceForm").show();
                         $(".error").html("Pas de huidige smoelen groep naam toe...");

                         $('#updateFace_book').css("opacity","1");
                         $('#updateFace_book').show("slow");
                         $('#addFace_book').hide("slow");
                         $("#updateImg_book").hide();


                         $(".faceInputs").hide();
                         $(".faceGroupUpdate").show();
                         $(".faceInputs").hide();
                         $("#selectGroup").hide();
                         $("#faceImg").hide();

                         $("#closeFaceBookForm").css("bottom","50px");


                     }



                    function callGroupImgDeleteForm()
                    {

                          $(".faceDeleteForm .error").html("Huidige smoelen groep verwijderen(Letop:als u een groep verwijdert, worden alle afbeeldingen die in staan ook mee verwijderd)");

                          $(".faceDeleteForm").css("opacity","1");
                          $(".faceDeleteForm").show();
                          $("#updateImg_book").hide();



                    }




                     function hideGroupImgDeleteForm()
                     {


                       $(".faceDeleteForm").hide("slow");
                       $(".faceDeleteForm").css("opacity","0");

                     }



                     function callFaceUpdateForm()
                     {

                        $(".error").html("Pas de huidige afbeelding gegevens toe...");
                        $("#updateImg_book").show("slow");
                         $('#updateFace_book').hide("slow");
                         $('#addFace_book').hide("slow");
                         $(".email").hide("slow");
                         $(".emailUpdate").show("slow");

                          $(".faceForm").css("opacity","0.98");
                          $(".faceForm").show();


                     }


                     var addFace_book = document.getElementById("addFace_book");
                     var faceInputs = document.querySelectorAll(".faceInputs");
                  //   var error = document.querySelector(".error");
                     addFace_book.addEventListener("click", addNewFace);
                     function addNewFace(e)
                     {

                           e.preventDefault();

                           var error = document.querySelector(".inputs .error");
                           var faceImg = document.getElementById("faceImg");
                           var faceImgFile = faceImg.files[0];
                           var formData = new FormData();
                           formData.append('faceImg', faceImgFile);

                        //   var groupName = faceInputs[0].value;
                           var imgName = faceInputs[0].value;
                          // var existedGroupName = faceInputs[2].value;
                           var imgDesc = faceInputs[1].value;

                           var imgEmail = $(".email").val();


                           xhr.onreadystatechange = function() {
                             if (this.readyState == 4 && this.status == 200) {

                                    error.innerHTML = xhr.responseText;

                                    if(  error.textContent == "Smoelen boek met succes toegevoegd...")
                                    {

                                      faceInputs[0].value = "";
                                    //  faceInputs[1].value = "";
                                      faceInputs[1].value = "";
                                    //  faceInputs[3].value = "";
                                      faceImg.value = "";

                                      hideFaceForm();
                                      displayGroupImages();

                                       //displayFaceGroup();
                                       //displayFaceImg();
                                       //getAllGroupName();

                                    }

                                }

                             };


                            if(faceImg.value != "" && imgName != "")
                            {

                              xhr.open('POST','../vrijwilliger/site/models/ajax_requests/smoelen_boek/addNewFace.php?imgName='+imgName+'&imgDesc='+imgDesc+'&imgEmail='+imgEmail,true);
                              xhr.send(formData);

                            }else{

                               error.innerHTML = "De velden met een stertje achter zijn verplicht...";

                            }


                     }


                     var updateIcon = document.getElementById("update");
                     var deleteIcon = document.getElementById("delete");
                  /*   function displayFaceGroup()
                     {

                         var groupContainer = document.getElementById("groupContainer");
                         var closeSidebar = document.getElementById("closeSidebar");

                         xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                  groupContainer.innerHTML = xhr.responseText;

                                  $(".groupUpdate").hide();
                                  $(".groupDel").hide();

                                  $(".groupUpdate").click(updateGroup);
                                  $(".groupDel").click(deleteGroup);

                                var groups = document.querySelectorAll(".groups");
                                for (var i = 0; i < groups.length; i++) {

                                    var groupsArr = groups[i];
                                    //groupsArr.addEventListener("click", displayGroupImages);

                                }


                                $('.paginationButt').click(pagination);

                              //  $(".groupUpdate").click(groupUpdateForm);
                              //  $(".groupDel").click(groupDeleteForm);



                              //  $(".imgCont").click(displayGroupImages);
                                GetAllGroupName();

                                updateIcon.addEventListener("click", function(){

                                   $(".groupUpdate").show("slow");
                                   $(".groupDel").hide("slow");


                                })


                                deleteIcon.addEventListener("click", function(){

                                     $(".groupDel").show("slow");
                                     $(".groupUpdate").hide("slow");

                                })


                                closeSidebar.addEventListener("click", function(){

                                  $(".groupUpdate").hide("slow");
                                  $(".groupDel").hide("slow");

                                })

                              }

                           };


                           xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayFaceGroup.php',true);
                           xhr.send();

                     }*/
                  //   displayFaceGroup();



                     function pagination(e)// geroepen in displayBlog()
                     {

                       var groupContainer = document.getElementById("groupContainer");
                       var closeSidebar = document.getElementById("closeSidebar");
                       paginationVal = e.target.textContent;

                         xhr.onreadystatechange = function()
                         {

                             if (this.readyState == 4 && this.status == 200)
                             {

                               groupContainer.innerHTML = xhr.responseText;

                               $(".groupUpdate").hide();
                               $(".groupDel").hide();

                               $(".groupUpdate").click(updateGroup);
                               $(".groupDel").click(deleteGroup);

                             var groups = document.querySelectorAll(".groups");
                             for (var i = 0; i < groups.length; i++) {

                                 var groupsArr = groups[i];
                                // groupsArr.addEventListener("click", displayGroupImages);

                             }


                             $('.paginationButt').click(pagination);

                           //  $(".groupUpdate").click(groupUpdateForm);
                           //  $(".groupDel").click(groupDeleteForm);



                            // $(".imgCont").click(displayGroupImages);
                             GetAllGroupName();

                             updateIcon.addEventListener("click", function(){

                                $(".groupUpdate").show("slow");
                                $(".groupDel").hide("slow");


                             })


                             deleteIcon.addEventListener("click", function(){

                                  $(".groupDel").show("slow");
                                  $(".groupUpdate").hide("slow");

                             })


                             closeSidebar.addEventListener("click", function(){

                               $(".groupUpdate").hide("slow");
                               $(".groupDel").hide("slow");

                             })

                           }

                        };


                        xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayFaceGroup.php?paginationVal='+paginationVal,true);
                        xhr.send();

                     }





                  /*   function updateGroup(e)//geroepen in displayFaceGroup
                     {

                         callGroupUpdateForm();

                         var groupName = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;
                         var error = document.querySelector(".inputs .error");

                         var updateFace_book = document.getElementById("updateFace_book");
                         var faceGroupUpdate = document.querySelector(".faceGroupUpdate");
                         var selectGroup = document.querySelector("#selectGroup");

                         updateFace_book.addEventListener("click", function(e){

                             e.preventDefault();

                             var newGroupName = faceGroupUpdate.value;


                             xhr.onreadystatechange = function() {
                                 if (this.readyState == 4 && this.status == 200) {

                                        error.innerHTML = xhr.responseText;
                                        faceGroupUpdate.value = "";

                                        if(error.textContent == "Huidige smoelen groepsnaam met succes aangepast...")
                                        {

                                            hideFaceForm();
                                            displayFaceGroup();

                                        }

                                    }


                               };


                               if(newGroupName != "")
                               {

                                 xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/updateGroup.php?newGroupName='+newGroupName+'&groupName='+groupName,true);
                                 xhr.send();

                               }else{

                                  error.innerHTML = "Geef een nieuw naam aan...";

                               }


                         })

                     }*/




                  /*   function deleteGroup(e)//geroepen in displayFaceGroup
                     {

                        callGroupImgDeleteForm();

                        var groupName = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;
                        var groupNameParent = e.target.parentNode.parentNode;

                        var sUserPass = document.querySelector("#sUserPass");
                        var imgDeleteForm = document.querySelector("#imgDeleteForm");
                        var error = document.querySelector(".faceDeleteForm .error");

                        imgDeleteForm.addEventListener("click", function(e){

                            e.preventDefault();

                            var sUserPassword = sUserPass.value;


                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {

                                       error.innerHTML = xhr.responseText;
                                       sUserPass.value.value = "";

                                       if(error.textContent == "Huidige groep met succes verwijderd...")
                                       {

                                           hideGroupImgDeleteForm();
                                           $(groupNameParent).toggle("explode");
                                           displayFaceGroup();

                                       }

                                   }


                              };


                              if(sUserPassword != "")
                              {

                                xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/deleteGroup.php?sUserPassword='+sUserPassword+'&groupName='+groupName,true);
                                xhr.send();

                              }else{

                                 error.innerHTML = "Voer het wachtwoord in...";

                              }


                     })

                   }*/


                     var postedGroupName;
                     function displayGroupImages()// alle afbeeldingen
                     {


                         var groupImg = document.getElementById("groupImg");
                         //var groupName = e.target.parentNode.childNodes[5].textContent;
                         //var groupName_2 = e.target.parentNode.parentNode.childNodes[5].textContent;

                        // alert(e.target.parentNode.parentNode.childNodes[3].className);

                      /*   if(e.target.parentNode.className == "groups")
                         {

                             postedGroupName = e.target.parentNode.childNodes[3].textContent;


                         }else if(e.target.parentNode.className == "imgCont")
                         {

                             postedGroupName = e.target.parentNode.parentNode.childNodes[3].textContent;
                             postedGroupName;

                         }*/


                         xhr.onreadystatechange = function() {
                             if (this.readyState == 4 && this.status == 200) {

                                    groupImg.innerHTML = xhr.responseText;

                                    $('.paginationImgButt').click(imgPagination);

                                    $("#groupImgContainer").show();
                                    $("#groupImgContainer").css("opacity","1");
                                    $("#groupImgContainer").css("zIndex","6");
                                    $("#heads").css("zIndex","5");

                                    $(".faceImgs").click(infoImages);

                                    $(".faceImgUpdate").hide();
                                    $(".faceImfDel").hide();


                                    $(".faceImfDel").click(deleteImg);
                                    $(".faceImgUpdate").click(updateImg);

                                    $("#update").click(function(){

                                      $(".faceImgUpdate").show("slow");
                                      $(".faceImfDel").hide("slow");

                                    })


                                    $("#delete").click(function(){


                                      $(".faceImgUpdate").hide("slow");
                                      $(".faceImfDel").show("slow");

                                    })


                                    $("#closeSidebar").click(function(){

                                      $(".faceImgUpdate").hide("slow");
                                      $(".faceImfDel").hide("slow");

                                    })


                                }


                           };


                           xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayGroupImages.php',true);
                           xhr.send();

                     }
                     displayGroupImages();



                     function imgPagination(e)
                     {

                       var groupImg = document.getElementById("groupImg");


                       var paginationVal = e.target.textContent;


                       xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                  groupImg.innerHTML = xhr.responseText;

                                  $('.paginationImgButt').click(imgPagination);

                              /*    if(e.target.textContent == paginationVal)
                                  {

                                      e.target.style.backgroundColor = "white";
                                      e.target.style.border = "2px solid red";
                                      e.target.style.color = "red";

                                  }*/

                                  $("#groupImgContainer").show();
                                  $("#groupImgContainer").css("opacity","1");
                                  $("#groupImgContainer").css("zIndex","6");
                                  $("#heads").css("zIndex","5");

                                  $(".faceImgs").click(infoImages);

                                  $(".faceImgUpdate").hide();
                                  $(".faceImfDel").hide();


                                  $(".faceImfDel").click(deleteImg);
                                  $(".faceImgUpdate").click(updateImg);

                                  $("#updateImg").click(function(){

                                    $(".faceImgUpdate").show("slow");
                                    $(".faceImfDel").hide("slow");

                                  })


                                  $("#deleteImg").click(function(){


                                    $(".faceImgUpdate").hide("slow");
                                    $(".faceImfDel").show("slow");

                                  })


                              }


                         };


                         xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayGroupImages.php?paginationVal='+paginationVal,true);
                         xhr.send();

                     }




                     function getCurrentImgData(imgName)
                     {

                          var faceInputs = document.querySelectorAll(".faceInputs");
                          var faceInputsUpdate = document.querySelector(".faceInputsUpdate");

                        //  var imgDesc = faceInputs[3].value;
                          faceInputs[0].value = imgName;
                          faceInputsUpdate.value = imgName;

                          xhr.onreadystatechange = function() {
                              if (this.readyState == 4 && this.status == 200) {

                                     faceInputs[1].value = xhr.responseText;

                                 }


                            };


                            xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/getImgData.php?imgName='+imgName,true);
                            xhr.send();

                     }




                     function updateImg(e)
                     {

                         callFaceUpdateForm()

                         var imgName = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;

                         getCurrentImgData(imgName);
                         $("#group_name").hide();
                         $("#selectGroup").hide();

                         var faceInputs = document.querySelectorAll(".faceInputs");
                         var faceGroupUpdate = document.querySelector(".faceGroupUpdate");
                         var faceInputsUpdate = document.querySelector(".faceInputsUpdate");
                         var selectGroup = document.getElementById("selectGroup");
                         var updateImg_book = document.querySelector("#updateImg_book");
                         var error = document.querySelector(".inputs .error");
                         var emailUpdate = document.querySelector(".emailUpdate");


                          updateImg_book.addEventListener("click", function(e){

                               e.preventDefault();

                               //var groupName = faceInputs[0].value;
                               var imageName = faceInputs[0].value;
                               //var selectGroupVal = faceInputs[2].value;
                               var imgDesc = faceInputs[1].value;
                               //var groupNameUpdate = faceGroupUpdate.value;
                               var imgNameUpdate = faceInputsUpdate.value;

                               var updateEmail = emailUpdate.value;

                               var faceImage = document.getElementById("faceImg").files[0];
                               var faceImge = document.getElementById("faceImg");
                               var formData = new FormData();
                               var uploadedImgName = faceImge.name;
                               formData.append('faceImg', faceImage);

                              xhr.onreadystatechange = function() {
                                  if (this.readyState == 4 && this.status == 200) {

                                         error.innerHTML = xhr.responseText;
                                         if(error.textContent == "Huidige afbeelding met succes aangepast...")
                                         {

                                              //faceInputs[0].value = "";
                                              faceInputs[0].value = "";
                                              //faceInputs[2].value = "";
                                            //  faceGroupUpdate.value = "";
                                              updateImg_book.value = "";

                                              e.target.parentNode.parentNode.childNodes[3].childNodes[3].innerHTML = imageName;
                                              e.target.parentNode.parentNode.childNodes[3].childNodes[3].src = "../vrijwilliger/public/media/smoelenBoek/"+uploadedImgName;

                                              hideFaceForm();

                                         }else if(error.textContent == "Huidige afbeelding met succes aangepast...Huidige afbeelding met succes aangepast...")
                                         {

                                           //faceInputs[0].value = "";
                                           faceInputs[0].value = "";
                                           //faceInputs[2].value = "";
                                           faceGroupUpdate.value = "";
                                           updateImg_book.value = "";

                                           hideFaceForm();

                                         }

                                     }


                                };


                                if(imageName != "" && imgDesc != "" )
                                {

                                  xhr.open('POST','../vrijwilliger/site/models/ajax_requests/smoelen_boek/updateImages.php?imgName='+imgName+'&imgDesc='+imgDesc+'&imgNameUpdate='+imgNameUpdate+'&imageName='+imageName+'&imgNameUpdate='+imgNameUpdate+'&updateEmail='+updateEmail,true);
                                  xhr.send(formData);

                                }else{

                                  error.innerHTML = "De afbeelding groepsnaam en afbeeldingnaam en de afbeelding beschrijving velden mogen niet leeg zijn...";

                                }


                          })


                     }






                     function deleteImg(e)
                     {

                        callGroupImgDeleteForm();
                        var imgName = e.target.parentNode.parentNode.childNodes[3].childNodes[3].textContent;
                        var imgNameParent = e.target.parentNode.parentNode;

                        var error = document.querySelector(".faceDeleteForm .error");
                        var sUserPass = document.getElementById("sUserPass");
                        var imgDeleteForm = document.getElementById("imgDeleteForm");

                        $(error).html("De afbeelding met naam <<"+' '+imgName+' '+">> verwijderen...");

                        imgDeleteForm.addEventListener("click", function(e){

                           e.preventDefault();
                           SUpassVal = sUserPass.value;

                           xhr.onreadystatechange = function() {
                               if (this.readyState == 4 && this.status == 200) {

                                      error.innerHTML = xhr.responseText;

                                      if(error.textContent == "Huidige afbeelding met succes verwijderd...")
                                      {

                                          $(imgNameParent).toggle("explode");
                                          hideGroupImgDeleteForm();
                                          sUserPass.value = "";

                                      }


                                  }

                              }


                              if(SUpassVal != "" )
                              {

                                xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/deleteImages.php?SUpassVal='+SUpassVal+'&imgName='+imgName,true);
                                xhr.send();

                              }else{

                                error.innerHTML = "Voer het wachtwoord in...";

                              }

                        })

                     }



                     function GetAllGroupName()// aangeroepen vanaf displayFaceGroup()
                     {

                        var allGroups = document.getElementById("allGroup");

                         xhr.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {

                                  allGroups.innerHTML += xhr.responseText;


                                  $(".groupsSelect").change(function(e){

                                    //var postedGroupName = e.target.textContent;
                                    var postedGroupName = $(".groupsSelect").val();
                                    var groupImg = document.getElementById("groupImg");

                                    xhr.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {

                                               groupImg.innerHTML = xhr.responseText;


                                               $("#groupImgContainer").show();
                                               $("#groupImgContainer").css("opacity","1");

                                               $(".faceImgs").click(infoImages);
                                               $(".faceImgUpdate").hide();
                                               $(".faceImfDel").hide();

                                               $("#groupImgContainer").css("zIndex","6");
                                               $("#heads").css("zIndex","5");

                                               $(".faceImfDel").click(deleteImg);
                                               $(".faceImgUpdate").click(updateImg);

                                               $("#updateImg").click(function(){

                                                 $(".faceImgUpdate").show("slow");
                                                 $(".faceImfDel").hide("slow");

                                               })


                                               $("#deleteImg").click(function(){


                                                 $(".faceImgUpdate").hide("slow");
                                                 $(".faceImfDel").show("slow");

                                               })


                                           }

                                        };


                                        xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayGroupImages.php?postedGroupName='+postedGroupName,true);
                                        xhr.send();

                                  })

                              }

                           };


                           xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/displayallGroupName.php',true);
                           xhr.send();

                     }
                    // GetAllGroupName();




                    function showImgAction()
                    {


                        updateIcon.addEventListener("click", function(){


                          //$(".faceImgUpdate").show("slow");
                        //  $(".faceImfDel").hide("slow");

                          var faceImgUpdate = document.querySelectorAll(".faceImgUpdate");
                          for (var i = 0; i < faceImgUpdate.length; i++) {

                              var faceImgUpdateArr = faceImgUpdate[i];
                            //  alert(faceImgUpdateArr);
                              $(faceImgUpdateArr).show("slow");

                          }

                        })


                        deleteIcon.addEventListener("click", function(){

                          $(".faceImgUpdate").hide("slow");
                          $(".faceImfDel").show("slow");

                        })


                        closeSidebar.addEventListener("click", function(){

                          $(".faceImgUpdate").hide("slow");
                          $(".faceImfDel").hide("slow");

                        })

                    }
                  ///  showImgAction();



                    function infoImages(e)// aangeroepen vanaf displayGroupImages
                    {


                         var imageName = e.target.parentNode.childNodes[3].textContent;
                         var imgsReceiver = document.getElementById("imgsReceiverCont");
                         $("#imgContainer").css("opacity","1");


                         xhr.onreadystatechange = function() {
                             if (this.readyState == 4 && this.status == 200) {

                                    imgsReceiver.innerHTML = xhr.responseText;

                                    $("#imgContainer").show("slow");
                                    $("#groupImgContainer").hide("slow");
                                    $("#imgContainer").css("zIndex","6");


                                    $("#closeImgs").click(function(){

                                         $("#imgContainer").hide("slow");
                                         $("#groupImgContainer").show("slow");
                                       //  $("#imgContainer").css("zIndex","0");

                                    })


                                }

                             };


                             xhr.open('GET','../vrijwilliger/site/models/ajax_requests/smoelen_boek/infoImages.php?imageName='+imageName,true);
                             xhr.send();


                    }



                })

              })

            </script>

          <?php

       }


       public function getAllGroupName()
       {

             $selectGroups = $this->PDO()->query("SELECT * FROM img_group_name");

             while($displayGroups = $selectGroups->fetch())
             {

                ?>

                  <option value="<?php echo $displayGroups['group_name'];?>"><?php echo $displayGroups['group_name'];?></option>

                <?php

             }

       }


  }

 ?>
