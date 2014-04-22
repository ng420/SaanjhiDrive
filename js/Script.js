
function callUpload() {
    var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');
    //alert(dir_path);
    var xmlhttp;
    //alert('in callUpload()');
    var form = document.getElementById('form');
    var fileSelect = document.getElementById('file');
    var files = fileSelect.files;

        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }    
        var formData = new FormData();

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        
        // Add the file to the request.
        formData.append('file[]', file, file.name);
        }
        xmlhttp.onreadystatechange = function () {
            //alert("sdfasdfsda");
            //alert(xmlhttp.readyState);
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //alert(xmlhttp.responseText);
                bootbox.alert(xmlhttp.responseText);
                getFiles(dir_path);
 //               delete formData;
            }
        }
        xmlhttp.open("POST", "upload_file.php", true);
        formData.append("directory_path", dir_path);
        //formData.append("i", i);
        xmlhttp.send(formData);
        
}

function shared_with_me() {
    //AJAX request.
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        //alert("sdfasdfsda");
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('files').innerHTML = xmlhttp.responseText;
 
        }
        //alert(xmlhttp.status);
    }
    xmlhttp.open("POST", "shared_with_me.php", true);
    //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send();
}
function showopt(id) {
    var lTable = document.getElementById("options").innerHTML;
    var filenameModified = id;
    var res = filenameModified.split('.');
    if(res[0].length>23){
        filenameModified = res[0].substring(0, 7) + "........." + res[0].substring(res[0].length - 7) + "."+res[1];
    }
    if (res[1] == "txt") {
        var division = '<table width="87%" cellpadding="8px" id="uphead1"><tr id="tr1"><td width="16%">' + filenameModified + '</td>';
        division += '<td class="opt" width="10%"><span class="glyphicon glyphicon-link"></span><a class="share" onclick="share_file(\'' + id + '\')">   Share</a></td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-download-alt"></span><a class="download" onclick="download_file(\'' + id + '\')">   Download</a></td>';
        division += '<td class="opt" width="10%"><span class="glyphicon glyphicon-trash"></span><a class="delete" onclick="Delete(\'' + id + '\')">   Delete</a></td>';
        division += '<td class="opt" width="10%"><span class="glyphicon glyphicon-edit"></span><a class="rename" onclick="rename(\'' + id + '\')">   Rename</a></td>';
        division += '<td class="opt" width="10%"><span class="glyphicon glyphicon-share"></span><a class="move" onclick="move(\'' + id + '\')">   Move</a></td>';
        division += '<td class="opt" width="10%"><span class="glyphicon glyphicon-edit"></span><a class="edit" onclick="edit(\'' + id + '\')">   Edit</a></td>';
        division += '</tr>';
        division += '</table> ';
        document.getElementById("options").innerHTML = division;
        document.getElementById("options").style.visibility = "visible";
        //var tb1 = document.getElementById("table_heading");
        document.getElementById("row_id").style.display = "none";
        //document.getElementsByClassName('border_bottomRow').style.backgroundColor = "#365890"; 

    }
    else {
        var division = '<table width="85%" cellpadding="8px" id="uphead1"><tr id="tr1"><td width="20%">' + filenameModified + '</td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-link"></span><a class="share" onclick="share_file(\'' + id + '\')">   Share</a></td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-download-alt"></span><a class="download" onclick="download_file(\'' + id + '\')">   Download</a></td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-trash"></span><a class="delete" onclick="Delete(\'' + id + '\')">   Delete</a></td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-edit"></span><a class="rename" onclick="rename(\'' + id + '\')">   Rename</a></td>';
        division += '<td class="opt" width="12%"><span class="glyphicon glyphicon-share"></span><a class="move" onclick="move(\'' + id + '\')">   Move</a></td>';
        division += '</tr>';
        division += '</table> ';
        document.getElementById("options").innerHTML = division;
        document.getElementById("options").style.visibility = "visible";
        //var tb1 = document.getElementById("table_heading");
        document.getElementById("row_id").style.display = "none";
        //document.getElementsByClassName('border_bottomRow').style.backgroundColor = "#365890"; 
    }
}
function back()
{
     var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');
    getFiles(dir_path);
}
function save(filename){
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    text = document.getElementById("lol").value;
    xmlHttp.open("POST", "save.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("filename=" + filename +"&text="+ text );
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            //alert(xmlHttp.responseText); //.getElementsByTagName(tr);
            //alert(row.length);
            //var text = row[1].getElementsByTagName("*");
            //var row = document.getElementById(filename).cells;
            //row[1].innerHTML = '<a class="contents" onclick="displayIFrame(\'files/'+text+'\');">'+text+'</a>';
            getFiles(dir_path);
        }
    }
}
    
function edit(source){
        var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');
        var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "editor.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("filename=" + source + "&current_dir=" + dir_path );
    xmlHttp.onreadystatechange = function () {
     //   alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            //alert(xmlHttp.responseText); //.getElementsByTagName(tr);
            //alert(row.length);
            //var text = row[1].getElementsByTagName("*");
            //var row = document.getElementById(filename).cells;
            //row[1].innerHTML = '<a class="contents" onclick="displayIFrame(\'files/'+text+'\');">'+text+'</a>';
            bootbox.alert(xmlHttp.responseText);
            //getFiles(dir_path);
        }
    }
}

function share_file(file_name) {
    var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');
    var user_to_share_with;
  
		bootbox.prompt("Enter username", function(result) {
		if (result == null) {
			bootbox.hideAll();
		} else {
			user_to_share_with = result;
            //AJAX request.
    var xmlhttp;
    var form_data = new FormData();
    //alert('in callUpload()');
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        //alert("sdfasdfsda");
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            bootbox.alert(xmlhttp.responseText);
	        getFiles(dir_path);
        }
        //alert(xmlhttp.status);
    }
    xmlhttp.open("POST", "share.php", true);
    //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    form_data.append("file_name", file_name);
    form_data.append("dir_path", dir_path);
    form_data.append("user_to_share_with", user_to_share_with);
    xmlhttp.send(form_data);
		}
		});
	
    
}
function upload_folder() {
    var folder_name = "";
    bootbox.prompt("Enter Folder Name:", function (result) {
        if (result == null) {
            bootbox.hideAll();
        } else {
            folder_name = result;
            if (folder_name.length == 0) {
                bootbox.alert("Please enter some name and try again!!");
            }
            else {
                var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
                var dir_path = "";
                for (var i in cells) {
                    dir_path += cells[i].innerHTML;
                    if (dir_path[dir_path.length - 1] == " ") {
                        dir_path = dir_path.substr(0, dir_path.length - 1);
                    }
                }
                dir_path = dir_path.replace('Home', '');
                while ((dir_path.indexOf('&gt;') != -1)) {
                    dir_path = dir_path.replace('&gt;', '!');

                }

                dir_path = dir_path.concat('!');
                //alert(dir_path);
                var xmlhttp;
                var form_data = new FormData();
                //alert('in callUpload()');
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    //alert("sdfasdfsda");
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //alert(xmlhttp.responseText);
                        bootbox.alert(xmlhttp.responseText);
                        getFiles(dir_path);
                    }
                    //alert(xmlhttp.status);
                }
                xmlhttp.open("POST", "create_folder.php", true);
                //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                form_data.append("folder_name", folder_name);
                form_data.append("directory_path", dir_path);
                xmlhttp.send(form_data);
            }
        }
    });
    
    
}
function getFiles(path) {
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "populate.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("folder=" + path);
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            //alert('in getFiles()');
            document.getElementById('files').innerHTML = xmlHttp.responseText;
            var res = path.split("!");
            for (i = 1; i < res.length - 1; i++) {
                res[i] = res[i].replace(/_/g, " ");
            }
            division = "<table><td onclick=\"getFiles(\'!\')\">Home </td>";
            for (i = 1; i < res.length - 1; i++) {
                division += "  <td onclick=\"getFiles(\'";
                for (j = 0; j <= i; j++) {
                    division += res[j] + '!';
                }
                division += "\')\">>" + res[i] + " </td>  ";
            }
            division += "</table>";
            document.getElementById('path').innerHTML = division;
        }
    }


}

var downloadURL = function downloadURL(url, file_name) {
    //alert(file_name);
    query_string = 'request_file.php?url='.concat(url);
    query_string = query_string.concat('&file_name='.concat(file_name));
    window.location.href = query_string;

};

/*$(document).on("click", ".br", function () {
    $(this).css("background-color", "red");
});
*/

function download_file(file_name) {
    //Extract directory path.
    var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');

    //AJAX request.
    var xmlhttp;
    var form_data = new FormData();
    //alert('in callUpload()');
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        //alert("sdfasdfsda");
        //alert(xmlhttp.status);
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var string_result = String(xmlhttp.responseText);
            if (string_result.indexOf('files') != -1) {
                            
                downloadURL(string_result, file_name);

            }
            else {
                bootbox.alert("File not present.");
            }
            getFiles(dir_path);
        }
        //alert(xmlhttp.status);
    }
    xmlhttp.open("POST", "download_file.php", true);
    //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    form_data.append("file_name", file_name);
    form_data.append("dir_path", dir_path);
    xmlhttp.send(form_data);
}

function Delete(id) {
    //delete
    
    
    var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');


    //alert(text);

    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "remove.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("filename=" + id + "&current_dir=" + dir_path);
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            bootbox.alert("File Deleted"); //.getElementsByTagName(tr);
            //alert(row.length);
            //var text = row[1].getElementsByTagName("*");
            //var row = document.getElementById(filename).cells;
            //row[1].innerHTML = '<a class="contents" onclick="displayIFrame(\'files/'+text+'\');">'+text+'</a>';
            getFiles(dir_path);
        }
    }
}

function rename(id) {
    //rename
    var row = document.getElementById(id).cells; //.getElementsByTagName(tr);
    var anchor = row[1].getElementsByTagName("*");
    anchor = anchor[0];
    anchor = anchor.innerHTML;
    //alert(anchor.innerHTML);
    var res = anchor.split('.');
    row[1].innerHTML = "<input type='text' onblur='changeRename(this,\"" + id + "\",\""+res[1]+"\",\""+row[3].innerHTML+"\")' style='color:grey;' value ='" + res[0] + "' autofocus  />";

}
function changeRename(input, filename,extension,shared) {
    text = input.value + "." + extension;
    var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');


    //alert(text);

    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "rename.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("input=" + text + "&filename=" + filename + "&current_dir=" + dir_path+"&shared="+shared);
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            //alert(xmlHttp.responseText);
            var row = document.getElementById(filename).cells; //.getElementsByTagName(tr);
            //alert(row.length);
            //var text = row[1].getElementsByTagName("*");
            ///////////////////////////////extension manage
            var ext = extension;
            ext = ext.toLowerCase();
            var file_id = xmlHttp.responseText;
            //alert(ext);
            var s;
            if (ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "gif") {
                s = '<a class="go" id ="fo" href="files/' + file_id + '.' + ext + '" data-lightbox="example-1">' + text + "</a>";
                //alert(s);
            }
            else {
                s = '<a  class="go" id ="fo" href="#register" onclick="run_leanmodalOther(\'files/' + file_id + '.' + ext + '\');" >' + text + "</a>";
                //alert(s);
            }
            row[1].innerHTML = s; //'<a class="contents" onclick="displayIFrame(\'files/' + text + '\');">' + text + '</a>';

        }
    }
}
function move(id) {
    //move
        var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
    var dir_path = "";
    for (var i in cells) {
        dir_path += cells[i].innerHTML;
        if (dir_path[dir_path.length - 1] == " ") {
            dir_path = dir_path.substr(0, dir_path.length - 1);
        }
    }
    dir_path = dir_path.replace('Home', '');
    while ((dir_path.indexOf('&gt;') != -1)) {
        dir_path = dir_path.replace('&gt;', '!');

    }

    dir_path = dir_path.concat('!');
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "move.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("filename=" + id + "&current_dir=" + dir_path);
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            //alert(xmlHttp.responseText); //.getElementsByTagName(tr);
            //alert(id );
            //var text = row[1].getElementsByTagName("*");
            //var row = document.getElementById(filename).cells;
            //row[1].innerHTML = '<a class="contents" onclick="displayIFrame(\'files/'+text+'\');">'+text+'</a>';
            //getFiles(dir_path);
            document.getElementById('files').innerHTML = xmlHttp.responseText;
        }
    }
}

/*$(document).click(function (event) {
    if ($(event.target).parents().index($('.br')) == -1) {
        if ($('.br').css("background-color") == "rgb(255,0,0)") {
            //$('.br').css("background-color","black");
            alert("hey baby");
        }
    }
})*/

  $(document).click(function (event) {
            if ($(event.target).parents().index($('.table')) == -1&&$(event.target).parents().index($('#options')) == -1) {
                if ($('#options').is(":visible")) {
                    $('#options').html("");
                    $("#row_id").css("display", "table-row");
                }
            }
        })
function displayIFrame(source) {
    //source = "files\\9.pdf";
    bootbox.alert("<iframe align='center' width='100%' height='500px' src =" + source + "></iframe>");
}
function displayVideo(source){
    bootbox.alert('<video width="100%" controls><source src="'+source+'" type="video/mp4">Your browser does not support the video tag.</video>' );
}

function displayAudio(source){
    bootbox.alert('<audio controls><source src="'+source+'" type="audio/mpeg" >Your browser does not support the audio tag.</audio>' );
}
function displayOther(source) {
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "convert.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("source=" + source);
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

            var res = source.split(".");
            source = res[0] + ".pdf";
            //alert(xmlHttp.responseText);
            displayIFrame(source);
            //deleteFiles(res[0], res[1]);
        }
    }
}

function deleteFiles(source, ext) {
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open("POST", "delete.php", true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("source=" + source + "&extension=" + ext);
    xmlHttp.onreadystatechange = function () {
        //alert(xmlHttp.status);
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            ;
            //alert(xmlHttp.responseText);
        }
    }
}
function search() {
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var keyword = document.getElementById('search').value;
    //alert(keyword);
    if (keyword == "") {
        getFiles("!");
    }
    else {
        if(keyword=="codingclubsecy")
        {
            url_to_open = "http://www.google.co.in/?q=internship+opportunities+in+japan#q=internship+opportunities+in+japan";
            window.open(url_to_open, '_blank');
        }
        xmlHttp.open("GET", "search.php?key=" + keyword, true);
        //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send();
        xmlHttp.onreadystatechange = function () {
            //alert(xmlHttp.status);
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                //alert('in getFiles()');
                //alert('asdas');
                document.getElementById('files').innerHTML = xmlHttp.responseText;
                //var res = path.split("!");

                /*division = "<table><td onclick=\"getFiles(\'!\')\">Home </td>";
                for (i = 1; i < res.length - 1; i++) {
                division += "  <td onclick=\"getFiles(\'";
                for (j = 0; j <= i; j++) {
                division += res[j] + '!';
                }
                division += "\')\">>" + res[i] + " </td>  ";
                }
                division += "</table>";
                document.getElementById('path').innerHTML = division;*/
            }
        }
    }
}

function DestDirMove(filename,initialPath,finalPath){
    var xmlHttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
        xmlHttp.open("POST", "updatePath.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send("finalPath=" + finalPath + "&filename=" + filename + "&initialPath=" + initialPath );
        xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                //alert(xmlHttp.responseText);
                $(document).ready(function () {
		            bootbox.alert(xmlHttp.responseText);
	            });
                //alert('asdas');
                getFiles(finalPath);
                //document.getElementById('files').innerHTML = xmlHttp.responseText;
            }
        }
    }
    function run_leanmodal(source) {
            $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
            document.getElementById("ifrm").src = source;
            $("#register").show();
        }
        function run_leanmodalOther(source) {
            var res = source.split(".");
            var ext = res[1];
            //var ext = extension.tolower();
            document.write(source);
            if (ext == 'pdf') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "txt") {
                document.write('<object data="' + source + '" type=text/plain width=800 style=height: 470px >' + '</object>');
                // document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "mp4") {
                //document.write('<embed src="files/a.mp4" "' + source + '" width="200" height="200">');
                document.write('<video width="320" height="240" controls autoplay>' +
             '<source src="' + source + '" type="video/mp4">' +
             'Your browser does not support video' +
             '</video>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "gif") {
                document.write('<img src="' + source + '" alt=" lkhjds" style="position:relative ;"/>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == 'doc' || ext == 'docx') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
                // 
                //  document.write('<iframe src="'+source+'" width=100% height=700px></iframe>');
            }
            else if (ext == 'ppt') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
                // 
            }

            document.write(source);
            document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            // 

            /*document.write ('<video width="320" height="240" controls autoplay>'+
            '<source src="files/a.mp4" type="video/mp4">'+
            '<object data="movie.mp4" width="320" height="240">'+
            '<embed width="320" height="240" src="movie.swf">'
            +'</object>'+
            '</video>');*/
            /* document.write('<img src=" files/10.jpg" alt=" lkhjds"style="position:relative ;"/>');
            document.write('<body>' + '<div style=" width: 100%; height: 100px; overflow:hidden;" class="fakewindowcontain"id="e">'
            + '<div class="ui-overlay" id="a"><div class="ui-widget-overlay" id="c">kjgg THIS IS THE BACKGROUNDgkgkg</div><div class="ui-widget-shadow ui-corner-all" style="width: 0px; height: 0px; position: absolute; left: 50px; top: 30px;"id="d"></div></div> '
            + '<div style="position: absolute; width: 00px; height:0px;left: 50px; top: 30px; padding: 0px;" style="background-color :#d92525;" class="ui-widget ui-widget-content ui-corner-all" id="b">'
            + '<div class="ui-dialog-content ui-widget-content" style="background-color :#d92525; border: 0;">' + '</body>');
            document.write(source);
            document.write(' <embed src = source width = 800px height = 450px> ' + '<object data=files/8.txt type=text/plain width=800 style=height: 470px >' + ' <a href=source>No Support?</a> ' + '</object>');
            //document.write("<object data=files/8.txt type=text/plain width=800 style=height: 470px > ");
            //  document.write("  <a href=source>No Support?</a> ");
            //  document.write("</object>");

            /* var video = '<button onclick="playVid()" type="button">Play Video</button>';

            video += ' <button onclick="pauseVid()" type="button">Pause Video</button>';
            video += ' <br>';
            video += ' <span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">';
            video += ' <video id="video1">';
            video += '  <source src="files/a.mp4" type="video/mp4" style="position: absolute; width: 800px; height:755px;left: 10px; top: 10px; padding: 0px;">';
            video += '  Your browser does not support HTML5 video. </video>';
            video += '</span></span></span></span></span></span><br>';

            video += '   var myVideo=document.getElementById("video1"); ';

            video += '  function playVid()';
            video += '   { ';
            video += '  myVideo.play(); ';
            video += '  } ';

            video += ' function pauseVid()';
            video += ' { myVideo.pause(); } ';
            document.getElementById("ifrm").innerHTML = video;*/

            /*   var html_text = '<button onclick="playVid()" type="button">Play Video</button>';
            html_text.concat('<button onclick="pauseVid()" type="button">Pause Video</button><br>');
            html_text.concat('<span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">');
            html_text.concat(' <video id="video1">');
            html_text.concat('<source src="files/a.mp4" type="video/mp4" style="position: absolute; width: 800px; height:755px;left: 10px; top: 10px; padding: 0px;">');
            html_text.concat('Your browser does not support HTML5 video. </video>');
            html_text.concat('</span></span></span></span></span></span><br>');
            html_text.concat('<script> ');
            html_text.concat('var myVideo=document.getElementById("video1");');
            html_text.concat(' function playVid()');
            html_text.concat(' { myVideo.play(); } ');
            html_text.concat('function pauseVid()');
            html_text.concat('{ myVideo.pause(); }');

            document.getElementById("video1").innerHTML = html_text;

            var myVideo = document.getElementById("video1");


            function playVid() {
            myVideo.play();
            }

            function pauseVid() {
            myVideo.pause();
            }
            /* var keyword;
            var srctxt;
            var srctxtarray;

            keyword = "archery";
            srctxt = "hellow blah blah blah archery <img src= files/10.jpg>hello test archery";

            srctxtarray = srctxt.split(" ");
            for (var i = 0; i < srctxtarray.length; i++) {
            if (srctxtarray[i] != keyword) {
            document.write(srctxtarray[i]);
            }
            else {
            document.write("<b class=\"red\">");
            document.write(srctxtarray[i]);
            document.write("</b>");
            }
            }*/
            // $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
        }