
    var depid;
    var refdepname;
    var refdepid;
    var refmodule;
   
   function loadDepartments()
    {     //var post_id;
      //var comment_id;
      var tbodyE3;

      var form = $(this).parent('form');
      //console.log($(this));
      refmodule='department';
      console.log("in view not in ajax");
        $.ajax
          ({ 
            url: 'http://localhost/ondt/public/department/'+refmodule+'/index',
            type: 'GET',
            dataType: 'json',
              success: function(data) 
                  {
                console.log("Inside success data"); 
                console.log(data);       
                var tbodyEl = $('#department_details');
                tbodyEl.html('');
                for(i in data)
                  { var dname = "'"+data[i]['depname']+"'";
                var did = "'"+data[i]['depid']+"'";

                    tbodyEl.append('<tr> <td class="id_department">'+data[i].depid+'</td><td class="namec">' + data[i].depname + '</td><td><button type="button" class="btn btn-md btn-info " onclick="viewstudent(this,'+dname+','+did+')" >View Students</button></td><td><button type="button" class="btn btn-md btn-default ec" onclick="edit_department(this,'+dname+','+did+')">Edit_Department</button><td><button type="button" class="btn btn-md btn-danger dc" onclick="delete_department(this,'+did+')">Delete_Department</button></td></td></tr>');
                    }
                  },
              error: function(data)
                {
              console.log("Inside Error");
              console.log(data);
              alert("Failed to load departments");
                }
          });
    }
 function viewstudent(button,dpname,dpid)
   { 
    var rowEl = $(this).closest('tr');
                 refdepname=dpname;
                 refdepid=dpid;
                var id = rowEl.find('.id_department').text();
                var name = rowEl.find('.namec').text();
//console.log(id);
              //  depid=id;
              var refmodule='student';
               var depname=name;
                //$traildepname=name;
                  $.ajax({
                    url: 'http://localhost/ondt/public/department/'+refmodule+'/index',
                    type: 'GET',
                   
                    dataType: 'json',
                    success: function (data) {
                      console.log("Inside success view student"); 
                      console.log(data);      
                      console.log("refdepid in vs"+refdepid); 
                      var tbodyE2 = $('#student_details');
                      tbodyE2.html('');
                        for(i in data)
                          {  var editname = "'"+data[i]['sname']+"'";
                             var editid="'"+data[i]['id']+"'";
                             var editage="'"+data[i]['sage']+"'";
                             var editemail="'"+data[i]['semail']+"'";
                             var editdepname="'"+data[i]['sdepname']+"'";
                           
                             console.log(data[i].sdepid);
                             console.log(data[i].sdepname);

                             if(refdepid == data[i].sdepid)
                               { 
                                tbodyE2.append('<tr> <td class="idc2">'+data[i].id+'</td><td>' + data[i].sname + '</td><td>' + data[i].semail + '</td><td>' + data[i].sage + '</td><td><button type="button" class="btn btn-md btn-default edstu" onclick="edstu(this,'+editname+','+editid+','+editage+','+editemail+','+editdepname+')">Edit_Student</button></td><td><button type="button" class="btn btn-md btn-danger ds" onclick="delete_student(this,'+editid+')"> Delete_Student</button></td></tr>');
                              }
                            }
                         //  tbodyE2.append('<tr><td><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo-S">Add Student </button><div id="demo-S" class="collapse"><form id="create-form-S">Name:<br> <input type="text" name="sname" id="create-student_name-S"><br>Age:<br> <input type="text" name="sage"id="create-student_age-S"><br>Email:<br> <input type="text" name="semail" id="create-student_email-S"><br><br>Department Name:<br><input type="text" value='+refdepname+' id="create-student_depname-S" name="sdepname" disabled><br><button  type="button"  class=" btn btn-default   " onclick= "add_student(event)">Add </button></form></div></td></tr>')


                          tbodyE2.append(' <button class="btn btn-primary" id="saddbutton" data-toggle="modal" data-target="#add_student">Add Student</button><div class="modal fade" id="add_student" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h2 class="modal-title" id="Modal"><b>New Student</b></h2></div><div id="add_student-body" class="modal-body">Name <br/><input type="text" id="create-student_name-S" name="sname"/><br/><br/>Email <br/> <input type="text" id="create-student_email-S" name="semail"/><br/><br/>age <br/> <input type="text" id="create-student_age-S" name="semail"/><br/><br/>Department<br/> <input type="text" value='+refdepname+' id="create-student_depname-S" disabled name="semail" /><br/><br/><input type="hidden" id="class_name" value="" name="class_name"/><button class="btn btn-success" id="addsubmitbutton" data-dismiss="modal" onclick= "add_student(event)">ADD</button></div></div></div></div>')
                        },
                    error: function(data){
                    console.log("Inside Error view student");
                    console.log(data);
                    alert("Sorry, we couldn't show you student_details at this moment try again.");
                        }
             });
      }
    function delete_student(button,deleteid)
    {   var depid =deleteid;
      var refmodule='student';
      alert("delete"+deleteid);
      $.ajax({
        type : "POST",
        url : 'http://localhost/ondt/public/department/'+refmodule+'/delete/'+depid,
        success : function(data) {
         viewstudent(this,refdepname,refdepid);
        },
        error : function  (data) {
          alert("Sorry, we couldn't delete you at this moment try again.");
          // body...
        }
      })

    }
    function delete_department(button,deleteid)
    {   var depid =deleteid;
      var refmodule='department';
      alert("delete"+deleteid);
      $.ajax({
        type : "POST",
        url : 'http://localhost/ondt/public/department/'+refmodule+'/delete/'+depid,
        success : function(data) {
         loadDepartments();
        },
        error : function(data)
        {
          alert("Sorry, we couldn't delete you at this moment try again.");
        }
      })

    }
      function edstu (button,editname,editid,editage,editemail,editdepname) {
  // body...
      event.preventDefault();
       var refmodule='student';
       var tbodyE3 = $('#edit_student_div');
              
               tbodyE3.html('');
               // console.log("inedit fu"+editdepname);
               //var product=JSON.parse(response);
               //console.log(product);
               
                  //tbodyE3.append('<h3>Edit Student Details </h3> <br>ID:<br> <input type="text" class="id" id="update-ID-A" size="35" value="'+editid+'" disabled><br>name:<br><input type="text" id="update-name-A" size="35" value="'+editname+'" ><br>Age:<br><input type ="text" id="update-age-A" size="35" value="'+editage+'"><br>Email:<br><input type ="text" id= "update-email-A" size="35" value="'+editemail+'"><br><button type="button" class="btn btn-md btn-info ups"onclick="update_student(event)" >update Student</button>');
               
                $(document).ready(function(){
        $("#edit_student").modal("show");
        });
                       tbodyE3.append('<div class="modal fade" id="edit_student" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><h2 class="modal-title" id="Modal">Edit Student</h2></center></div><div id="edit_student-body" class="modal-body"><br>ID:<br> <input type="text" class="id" id="update-ID-A" size="35" value="'+editid+'" disabled><br>Name:<br><input type="text" id="update-name-A" size="35" value="'+editname+'" ><br>Age:<br><input type ="text" id="update-age-A" size="35" value="'+editage+'"><br>Email:<br><input type ="text" id= "update-email-A" size="35" value="'+editemail+'"><br>Department:<br><input type ="text" id= "update-depname-A" size="35" value="'+editdepname+'" disabled><br><br><button type="button" class="btn btn-md btn-warning ups"onclick="update_student(event)" >update Student</button></div></div></div></div>');
             
        }

      function edit_department(button,editname,editid) {
  // body...
        event.preventDefault();
  
        var tbodyE3 = $('#edit_student_div');
              
               tbodyE3.html('');
                
               //var product=JSON.parse(response);
               //console.log(product);
               
                 // tbodyE3.append('<h3>Edit Department Details </h3> <br>ID:<br> <input type="text" class="id" id="update-ID-Dep" size="35" value="'+editid+'" disabled><br>Department name:<br><input type="text" id="update-name-Dep" size="35" value="'+editname+'" ><br><br><button type="button" class="btn btn-md btn-info ups"onclick="updep(event)" >update Department</button>');
                  $(document).ready(function(){
                   $("#edit_department").modal("show");
                     });
             tbodyE3.append('<div class="modal fade" id="edit_department" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><center><h2 class="modal-title" id="Modal">Edit Departmentt</h2></center></div><div id="edit_student-body" class="modal-body"><br>ID:<br> <input type="text" class="id" id="update-ID-Dep" size="35" value="'+editid+'" disabled><br>Name:<br><input type="text" id="update-name-Dep" size="35" value="'+editname+'" ><br><br><button type="button" class="btn btn-md btn-warning ups"onclick="updep(event)" >update Department</button></div></div></div></div>');         
             
        }

        function updep(event)
          {

            event.preventDefault();
//alert("add stu");
            var refmodule='department';
            console.log("hellooo edit dep...!");
            var depid =$('#update-ID-Dep').val();
            var  newName  = $('#update-name-Dep').val();
            console.log(newName);
        
            $.ajax({

               url: 'http://localhost/ondt/public/department/'+refmodule+'/edit/'+depid+'/'+newName,
                type: 'POST',
                contentType: 'json',
                data: JSON.stringify({depid: depid,depname: newName}),

                
                success: function(response) {
                
                console.log('sent from scripts'+ newName);
               // console.log(data);
                loadDepartments();  
                },
              error: function(response)
              {console.log("inside add stu error");
              console.log(response);
              alert("Sorry, we couldn't update your department at this moment try again.");
              }
           
                });

         }
        function add_student(event)
          {
          event.preventDefault();
          var refmodule='student';
          console.log("hellooo ad stu...!");
          var  newName  = $('#create-student_name-S').val();
          var newAge= $('#create-student_age-S').val();
          var newEmail=$('#create-student_email-S').val();
          var newDepname=$('#create-student_depname-S').val();
           $.ajax({
              url: 'http://localhost/ondt/public/department/'+refmodule+'/add/'+newName+'/'+newAge+'/'+newEmail+'/'+newDepname+'/'+refdepid,
           type: 'POST',
            contentType: 'json',
            data: JSON.stringify({sname: newName,semail:newEmail,sage:newAge,sdepname:newDepname,sdepid:refdepid}),
               success: function(response) {
                console.log("refdepid"+refdepid); 
                console.log('sent from scripts'+ newName);
                viewstudent(this,refdepname,refdepid);
                   },
             error: function(response)
            {console.log("inside add stu error");
            console.log(response);
            alert("Sorry, we couldn't add you at this moment try again.");}
          });
      }
      function add_department(event)
      {
              event.preventDefault();
              var refmodule='department';
        console.log("hellooo ad department...!");
        var  newName  = $('#create-department_name-A').val();
         $.ajax({
          url: 'http://localhost/ondt/public/department/'+refmodule+'/add/'+newName,
           type: 'POST',
            contentType: 'json',
            data: JSON.stringify({depname: newName}),
            success: function(response) {
                console.log('sent from scripts dep '+ newName);
                loadDepartments();
                },
            error: function(response)
            {console.log("inside add dep error");
            console.log(response);
            alert("sorry,Department couldn't be added !");
            }
              });
      }
  // update stu
      function update_student(event)
      { var refmodule='student';
        event.preventDefault();
        console.log("hellooo edit stu...!");
        var depid =$('#update-ID-A').val();
         var  newName  = $('#update-name-A').val();
        var newAge= $('#update-age-A').val();
        var newEmail=$('#update-email-A').val();
        var newDepname=$('#update-depname-A').val();
        console.log(newName);
        console.log(newAge);
        console.log(newEmail);
       console.log(newDepname);
        $.ajax({
            url: 'http://localhost/ondt/public/department/'+refmodule+'/edit/'+depid+'/'+newName+'/'+newAge+'/'+newEmail+'/'+newDepname+'/'+refdepid,
           type: 'POST',
            contentType: 'json',
            data: JSON.stringify({id: depid,sname: newName,semail:newEmail,sage:newAge,sdepname:newDepname,sdepid:refdepid}),
              success: function(response) {
                console.log('sent from scripts'+ newName);
                viewstudent(this,refdepname,refdepid);
            },
            error: function(response)
            {console.log("inside add stu error");
            console.log(response);
             alert("sorry,Update Failed");
            }
           
        });

      }