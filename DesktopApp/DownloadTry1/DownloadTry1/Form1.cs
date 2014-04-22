using System;
//using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.Collections.ObjectModel;
using System.IO;

namespace DownloadTry1
{
    public partial class Form1 : Form
    {
        string username = "";//= "abhishek";                                                                                    // this users username
        string password  = "";//= "anything";                                                                                   // password of user
        string clientHome1 = "";// "C:\\Users\\Abhishek Sen\\Downloads\\___SAANJHI";                                            // Saanjhi drive folder on desktop
        string clientHome2 = "";//"C:\\\\Users\\\\Abhishek Sen\\\\Downloads\\\\___SAANJHI";                                     // same as above, but "\\" replaced with "\\\\"
        string tempToGenerateFile = "";
        string tempToGenerateFilesToUploadToServer = "";                                                                        // list of files to be uploaded
        string tempToGenerateFOLDERToUploadToServer = "";
        int syncComplete = 0;
        //string path = "http://172.16.25.157/";
        string path = "http://localhost:24667/";                                                                            
        string saveTempFilesPath = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData),"Saanjhi Drive")  + "\\";          // location of temp files in appdata of clients desktop

        public Form1()
        {
            InitializeComponent();
        }

        private void FileDownloadCompleteTEMP(object sender, AsyncCompletedEventArgs e)
        {
        }

        //private void Form1_Load(object sender, EventArgs e)
        //{
        //    try
        //    {
        //        WebClient webClient = new WebClient();
        //        Stream stream = webClient.OpenRead(path+"upload/DownloadQueue.txt");
        //        StreamReader streamReader = new StreamReader(stream);
        //        Collection<string> stringCollection = new Collection<string>();
        //        string line;
        //        while ((line = streamReader.ReadLine()) != null)
        //        {
        //            stringCollection.Add(line);
        //            DownloadFromServer(line);
        //        }

        //        //contentsTextBox.Lines = stringCollection.ToArray();
        //        ////   webBrowser1.DocumentText = contentsTextBox.Text;
        //        //MessageBox.Show(contentsTextBox.Text);

        //    }
        //    catch
        //    {
        //        MessageBox.Show("Cannot downlaod file");
        //    }
        //}

        private int DownloadFromServer(string whereToDownloadFrom,string filePathOnClient,string actualFileName)
        {
            try
            {
                WebClient wc = new WebClient();
                wc.DownloadFileCompleted += new AsyncCompletedEventHandler(FileDownloadCompleteTEMP);
                Uri url = new Uri(whereToDownloadFrom);
                //wc.DownloadFileAsync(url, filePathOnClient + whereToDownloadFrom.Substring(whereToDownloadFrom.LastIndexOf('/') + 1));
                wc.DownloadFileAsync(url, filePathOnClient + actualFileName);
                return 1;
            }
            catch
            {
                return -1;
            }

        }               // function to download file from server
        private int getQueueFromServer()
        {
            try
            {
                WebClient webClient = new WebClient();
                Stream stream = webClient.OpenRead(path+"upload/DownloadQueue.txt");
                StreamReader streamReader = new StreamReader(stream);
                Collection<string> stringCollection = new Collection<string>();
                string line;
                while ((line = streamReader.ReadLine()) != null)
                {
                    stringCollection.Add(line);
                    //DownloadFromServer(line);
                }
                return 1;
            }
            catch
            {
                return -1;
            }
        }                                                                                       // not used
        private int uploadFileToServer(string fullUploadFilePath)
        {
            //var FD = new System.Windows.Forms.OpenFileDialog();
            //if (FD.ShowDialog() == System.Windows.Forms.DialogResult.OK)
            //{
            //    string fileToOpen = FD.FileName;

            //    System.IO.FileInfo File = new System.IO.FileInfo(FD.FileName);

            //    //OR

            //    StreamReader reader = new StreamReader(fileToOpen);
            //    //etc
            //    MessageBox.Show(fileToOpen, "My Application",
            //  MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            WebClient client = new WebClient();
            //string fullUploadFilePath = @fileToOpen;
            string uploadWebUrl = path+"DesktopApp/upload.aspx";


            try
            {
                //MessageBox.Show(fullUploadFilePath);
                client.UploadFile(uploadWebUrl, fullUploadFilePath);
                return 1;
            }
            catch (Exception e)
            {
                //MessageBox.Show(fullUploadFilePath);
                MessageBox.Show("Error in upload File to Server\n"+e.Message, "My Application",
                MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
                return -1;
            }
            //}


        }                                                              // function to upload file to server

        private int DeleteFileOnDesktop(string file)
        {
            try
            {
                File.Delete(file);
                return 1;
            }
            catch
            {
                return -1;
            }
        }                                                                           // function to delete files on desktop

        private void Sync_Click(object sender, EventArgs e)
        {
            if(clientHome1!="")
            {
            System.IO.StreamWriter file = new System.IO.StreamWriter(saveTempFilesPath +"status.txt");
            file.WriteLine("NewSync;"+username+";"+password);
            file.Close();
            WebClient client = new WebClient();
            //string fullUploadFilePath = @fileToOpen;
            string uploadWebUrl = path+"DesktopApp/uploadStatus.aspx";
            try
            {

                System.Net.ServicePointManager.Expect100Continue = false; //NEWLY ADDED//


                client.UploadFile(uploadWebUrl, saveTempFilesPath + "status.txt");
                syncComplete = 1;
            }
            catch (Exception ee)
            {
                MessageBox.Show("Error :( "+ee.Message, "My Application",
                MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            }
            }
            else{

                MessageBox.Show("Please Select Target Folder first");
            }

        }                                                                    // function to send username, password to server for verification

        private void DownloadStatusFile_Click(object sender, EventArgs e)
        {
            Sync_Click(sender, e);
            if (clientHome1 != "" && syncComplete ==1)
            {
                string status = "No";
                try
                {
                    

                    WebClient webClient = new WebClient();
                    Stream stream = webClient.OpenRead(path+"DesktopApp/status.txt");
                    
                    StreamReader streamReader = new StreamReader(stream);
                    string line ;
                    while ((line = streamReader.ReadLine()) != null)
                        status = line;
                    
                    if (status == "ReadyToDownload")
                    {
                        
                        string line1;
                        Stream stream1 = webClient.OpenRead(path+"DesktopApp/currentStatus.txt");
                        StreamReader streamReader1 = new StreamReader(stream1);

                        System.IO.StreamWriter file = new System.IO.StreamWriter(saveTempFilesPath + "currentStatus.txt");
                        while ((line1 = streamReader1.ReadLine()) != null)
                        {
                            //MessageBox.Show("hi");
                            string v = line1.Replace("!", "\\\\");
                            file.WriteLine(v);
                        }
                        file.Close();

                        System.IO.StreamReader fileToRead = new System.IO.StreamReader(saveTempFilesPath + "currentStatus.txt");
                        while ((line = fileToRead.ReadLine()) != null )
                        {
                            if (line.Length > 2)
                            {
                                string[] columns = line.Split(';');
                                StringBuilder b = new StringBuilder(columns[2]);// edit database to remove the last slash
                                b.Insert(0, clientHome2);
                                columns[2] = b.ToString(); 
                                if (columns[3] == "1") // isFolder
                                {
                                    
                                    if (!Directory.Exists(columns[2] + columns[1].Substring(6)))
                                    {                                        
                                        System.IO.Directory.CreateDirectory(columns[2] + columns[1].Substring(6)); 
                                    } 
                                }
                                else // is file
                                {
                                    if (!File.Exists(columns[2])) //if file doesn't exist Download File
                                    {
                                        string ext = columns[1].Substring(columns[1].LastIndexOf('.') + 1);
                                        int s = DownloadFromServer(path+"files/" + columns[0].ToString() + "." + ext, columns[2],columns[1]);//file path
                                        if (s != 1)
                                        {
                                            MessageBox.Show("Download Failed!!\n" + columns[1] + " Could not be downloaded.");
                                        }
                                    }
                                }
                            }

                        }
                        fileToRead.Close();
                    }
                    else if (status == "failed") 
                    {
                        MessageBox.Show("Incorrect Username or Password !!");
                    }
                    else
                    {
                        MessageBox.Show("Network Problem....Try again !!");
                    }
                }
                catch(Exception qws)
                {
                    MessageBox.Show("Cannot download file" + qws.Message);
                }
                if (status == "ReadyToDownload")
                {
                    try
                    {
                        DeleteDelete();
                    }
                    catch(Exception yuvdun){}

                    try
                    {
                        //DeleteDelete();
                        /////////////////////////////////////////////////////Generate Present Structure of Home directory//////////////////////////////////////////////////////////////
                        DirectoryInfo tDir = new DirectoryInfo(@clientHome1);
                        TraverseDirs(tDir);
                        System.IO.StreamWriter fileStructure = new System.IO.StreamWriter(saveTempFilesPath + "presentStructure.txt");
                        tempToGenerateFile = tempToGenerateFile.Replace("\\", "\\\\");
                        fileStructure.WriteLine(tempToGenerateFile);
                        fileStructure.Close();
                        tempToGenerateFile = tempToGenerateFile.Replace("\\\\", "\\");
                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        ///////////////////////////////////////////////////Delete Files which are not there on server but are in client's desktop///////////////
                        //DirectoryInfo tDir1 = new DirectoryInfo(@clientHome1);
                        //TraverseDirsTODelete(tDir1);
                        ////////////////////////////////////////////////////Upload files which are not there on server/////////////////////////////////////////
                        generateFilesToUploadToServerandUploadThem();

                        //////////this.Close();
                    }
                    catch (Exception erygytf)
                    {
                        MessageBox.Show(erygytf.Message);
                    }
                }
            
                else if (status == "failed") ;
                else
                {
                    if (syncComplete == 1)
                        MessageBox.Show("Please Select Target Folder first");
                    else
                        MessageBox.Show("First Get Ready to check Connection and verify your user Details !");
                }
                }

                
                
                    
        }                                                       // event handler - syncs all the files

       
        private void TraverseDirs(DirectoryInfo dir)
        {
            
            // Subdirs
            try         // Avoid errors such as "Access Denied"
            {
                foreach (DirectoryInfo iInfo in dir.GetDirectories())
                {
                    string dirPath = iInfo.FullName;                    
                                //MessageBox.Show(dirPath);
                    string withoutInitialHeader = iInfo.FullName.Substring(clientHome1.Length);
                                //MessageBox.Show(withoutInitialHeader);
                    dirPath = dirPath.Replace("\\", "\\\\");
                    string nameOfFolder = "dwalin"+ dirPath.Substring(dirPath.LastIndexOf('\\') + 1); //1 because to exclude '\'
                                //MessageBox.Show(nameOfFolder);
                    string afterHeaderWithoutName = withoutInitialHeader.Substring(0, withoutInitialHeader.Length - (nameOfFolder.Length - 6)); //to eliminate dwalin
                                //MessageBox.Show(afterHeaderWithoutName);
                    tempToGenerateFile = tempToGenerateFile + nameOfFolder + ";" + afterHeaderWithoutName + "\r\n"; //eg. name;pathafterdropboxhomefolder
                                //MessageBox.Show(tempToGenerateFile);
                    TraverseDirs(iInfo);
                }
            }
            catch (Exception)
            {
                MessageBox.Show("Traverse Dir Error");
            }

            // Subfiles
            try         // Avoid errors such as "Access Denied"
            {
                foreach (FileInfo iInfo in dir.GetFiles())
                {
                    string dirPath = iInfo.FullName;
                    string withoutInitialHeader = iInfo.FullName.Substring(clientHome1.Length);
                    dirPath = dirPath.Replace("\\", "\\\\");
                    string nameOfFile = dirPath.Substring(dirPath.LastIndexOf('\\') + 1);
                    string afterHeaderWithoutName = withoutInitialHeader.Substring(0, withoutInitialHeader.Length - nameOfFile.Length);
                    //fileStructure.WriteLine(nameOfFile + ";" + afterHeaderWithoutName);
                    tempToGenerateFile = tempToGenerateFile + nameOfFile + ";" + afterHeaderWithoutName + "\r\n";
                    //MessageBox.Show(tempToGenerateFile);
                }
            }
            catch (Exception)
            {
            }
        }             
        
        
        
        private void DeleteDelete()
        {
            try
            {
                System.IO.StreamReader fileToRead = new System.IO.StreamReader(saveTempFilesPath + "currentStatus.txt");
                //int flagToDelete =0;
                string line;
                while ((line = fileToRead.ReadLine()) != null)
                {
                    if (line.Length > 2)
                    {
                        string[] columns = line.Split(';');
                        if(columns[3] == "2")
                        {
                            int kk=DeleteFileOnDesktop(clientHome1 + columns[2] + columns[1]);
                            //Delete
                        }
                    }
                }
                fileToRead.Close();
            }
            catch(Exception euidf)
            {}
        }

        
        
        
        
        
        
                                                                      // traverse all the directories inside SaanjhiDrive folder

        private void TraverseDirsTODelete(DirectoryInfo dir)
        {

            // Subdirs
            try         // Avoid errors such as "Access Denied"
            {
                foreach (DirectoryInfo iInfo in dir.GetDirectories())
                {
                    string dirPath = iInfo.FullName;
                    string withoutInitialHeader = iInfo.FullName.Substring(clientHome1.Length);
                    dirPath = dirPath.Replace("\\", "\\\\");
                    string nameOfFolder = "dwalin" + dirPath.Substring(dirPath.LastIndexOf('\\') + 1); //1 because to exclude '\'
                    string afterHeaderWithoutName = withoutInitialHeader.Substring(0, withoutInitialHeader.Length - (nameOfFolder.Length - 6)); //to eliminate dwalin
                    //tempToGenerateFile = tempToGenerateFile + nameOfFolder + ";" + afterHeaderWithoutName + "\r\n"; //eg. name;pathafterdropboxhomefolder
                    string line, tt = afterHeaderWithoutName.Replace("\\", "\\\\");
                    System.IO.StreamReader fileToRead = new System.IO.StreamReader(saveTempFilesPath + "currentStatus.txt");
                    int flagToDelete =0;
                    while ((line = fileToRead.ReadLine()) != null)
                    {
                        if (line.Length > 2)
                        {
                            string[] columns = line.Split(';');
                            if(nameOfFolder == columns[1] && afterHeaderWithoutName == columns[2])
                            {
                                flagToDelete = 1;
                                break;
                            }
                        }
                    }
                    fileToRead.Close();
                    if (flagToDelete == 0)
                    {
                        //dir.Delete(true); // true => recursive delete
                        //delete;
                    }
                    //else
                        //TraverseDirs(iInfo);
                }
            }
            catch (Exception)
            {
                MessageBox.Show("Traverse Dir Error");
            }

            // Subfiles
            try         // Avoid errors such as "Access Denied"
            {
                foreach (FileInfo iInfo in dir.GetFiles())
                {
                    string dirPath = iInfo.FullName;
                    string withoutInitialHeader = iInfo.FullName.Substring(clientHome1.Length);
                    dirPath = dirPath.Replace("\\", "\\\\");
                    string nameOfFile = dirPath.Substring(dirPath.LastIndexOf('\\') + 1);
                    string afterHeaderWithoutName = withoutInitialHeader.Substring(0, withoutInitialHeader.Length - nameOfFile.Length);
                    //tempToGenerateFile = tempToGenerateFile + nameOfFile + ";" + afterHeaderWithoutName + "\r\n";
                    string line,tt = afterHeaderWithoutName.Replace("\\","\\\\");
                    System.IO.StreamReader fileToRead = new System.IO.StreamReader(saveTempFilesPath + "currentStatus.txt");
                    int flagToDelete = 0;
                    while ((line = fileToRead.ReadLine()) != null)
                    {
                        if (line.Length > 2)
                        {
                            //MessageBox.Show(line + "\n"+ nameOfFile + "\n" + afterHeaderWithoutName);
                            string[] columns = line.Split(';');
                            if (nameOfFile == columns[1] && tt == (columns[2]))
                            {
                                flagToDelete = 1;
                                break;
                            }
                        }
                    }
                    fileToRead.Close();
                    if (flagToDelete == 0)
                    {
                        int r = DeleteFileOnDesktop(iInfo.FullName);
                        if (r != 1) MessageBox.Show("Could not delete");
                        //else { MessageBox.Show("Deleted"); }
                        //delete;
                    }
                }
            }
            catch (Exception)
            {
            }
        }                                                                   // not used

        private void generateFilesToUploadToServerandUploadThem()
        {
            string line1,line2;
            System.IO.StreamReader readCurrent = new System.IO.StreamReader(saveTempFilesPath + "presentStructure.txt"); // on client
            while ((line1 = readCurrent.ReadLine()) != null)
            {
                if (line1.Length > 2)
                {
                    int flag = 0;
                    string[] columns1 = line1.Split(';');
                    System.IO.StreamReader readPresent = new System.IO.StreamReader(saveTempFilesPath + "currentStatus.txt");// on server
                    while ((line2 = readPresent.ReadLine()) != null)
                    {
                        
                        if (line2.Length > 2)
                        {
                            string[] columns2 = line2.Split(';');
                            //MessageBox.Show(columns1[0] +"\n" +columns2[1]);
                            if (columns2[1] == columns1[0] && columns2[2] == columns1[1])
                            {
                                flag = 1;
                                break;
                            }
                        }
                    }
                    if (flag == 0)
                    {
                        if (!columns1[0].StartsWith("dwalin")) //if it is file
                        {
                            string t = columns1[1] + columns1[0];
                            t = t.Replace("\\\\", "\\");
                            //MessageBox.Show(clientHome1 + t);
                            uploadFileToServer(clientHome1 + t); //upload File To Server
                            tempToGenerateFilesToUploadToServer = tempToGenerateFilesToUploadToServer + columns1[0] + ";" + columns1[1] + ";" + "0" + "\n";
                        }
                        else
                            tempToGenerateFOLDERToUploadToServer = tempToGenerateFOLDERToUploadToServer + columns1[0] + ";" + columns1[1] + ";" + "1" + "\n";
                    }
                    readPresent.Close();
                }
            }
            
            readCurrent.Close();
            StreamWriter filefromc2s = new StreamWriter(saveTempFilesPath + "xtrafiles2beadded2server.txt");
            filefromc2s.WriteLine(tempToGenerateFilesToUploadToServer); // one extra \n
            filefromc2s.WriteLine("`");
            filefromc2s.WriteLine(tempToGenerateFOLDERToUploadToServer);
            filefromc2s.Close();

            WebClient client = new WebClient();
            string uploadWebUrl = path+"DesktopApp/XtraFilesFromClient2Server.aspx";
            try
            {
                client.UploadFile(uploadWebUrl, saveTempFilesPath + "xtrafiles2beadded2server.txt");
                MessageBox.Show("Synced");
            }
            catch (Exception )
            {
                MessageBox.Show("Error in Uploading to Server", "My Application",
                MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            }


        }                                                              // generate list of files to upload on server and uploads them too

        private void button1_Click(object sender, EventArgs e) //save
        {
             username = txtBoxUsername.Text;
             password = txtBoxPassword.Text;
             if (username == "" || password == "" || textBox1.Text == "")
             {
                 MessageBox.Show("Please Fill Proper credentials");
             }
             else
             {
                 if (!Directory.Exists(saveTempFilesPath))
                 {
                     DirectoryInfo di = Directory.CreateDirectory(saveTempFilesPath);
                 }
                 StreamWriter file = new StreamWriter(saveTempFilesPath + "userCredentials.txt");
                 file.WriteLine(username);
                 file.WriteLine(password);
                 if (clientHome1 != "")  //if select folder is pressed first then write path only when usern and passw has already beign written otherwise it will be in 1st line
                 {
                     file.WriteLine(clientHome1);
                 }
                 if (textBox1.Text.Length > 5)
                 {
                     file.WriteLine(textBox1.Text);
                     path = textBox1.Text;
                 }
                 file.Close();

                 MessageBox.Show("Saved");
                 lblSettings.Text = "Settings";
                 panel4.Visible = false;
                 panel1.Visible = true;
                 panel1.Dock = DockStyle.Fill;
                 //verify
                // curUser.Text = username + " is Logged In";
             }
        }                                                           // event handler: save button

        private void lblSettings_Click(object sender, EventArgs e)
        {
            if (lblSettings.Text == "Settings")
            {
                lblSettings.Text = "Back";
                panel1.Visible = false;
                panel4.Visible = true;
                panel4.Dock = DockStyle.Fill;

                if (File.Exists(saveTempFilesPath + "userCredentials.txt")) //file exits only when it is filled with credentials after 1st login (1st click on save button)
                {
                    string firstline = "";
                    StreamReader file = new StreamReader(saveTempFilesPath + "userCredentials.txt");
                    firstline = file.ReadLine();
                    if (firstline.Length > 2) //if file is there but not empty or having \n
                    {
                        username = firstline;
                        password = file.ReadLine();
                        clientHome1 = file.ReadLine();
                        clientHome2 = clientHome1.Replace("\\","\\\\");
                        path = file.ReadLine();
                    }
                    file.Close();

                }


                txtBoxUsername.Text = username;
                txtBoxPassword.Text = password;
                textBox1.Text = path;
            }
            else
            {
                lblSettings.Text = "Settings";
                panel4.Visible = false;
                panel1.Visible = true;
                panel1.Dock = DockStyle.Fill;
            }

            if (username == "" || password == "")
            {
               // curUser.Text = "No User currently Logged in ";
                curFolder.Text = "No Path Selected";
            }
            else
            {//check if connection is proper
              //  curUser.Text = username+" is logged in";
                curFolder.Text = "Current Drive Path : "+clientHome1;
            }


            
            
        }                                                             // event handler: click on "Settings"

        private void button2_Click(object sender, EventArgs e)//select folder
        {
            FolderBrowserDialog folderBrowserDialog1 = new FolderBrowserDialog();

            folderBrowserDialog1.ShowDialog();

            String makeDirectoryForDrivePath = folderBrowserDialog1.SelectedPath;
           // MessageBox.Show(makeDirectoryForDrivePath, "My Application", MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            if (makeDirectoryForDrivePath != "")
            {
                clientHome1 = makeDirectoryForDrivePath;
                clientHome2 = makeDirectoryForDrivePath.Replace("\\","\\\\");
                curFolder.Text = "Current Drive Path is " + clientHome1;
                if (username != "") //if username is assigned then it is writtern as 1st line of userCredentials
                {
                    StreamWriter file = new StreamWriter(saveTempFilesPath + "userCredentials.txt");
                    file.WriteLine(username);
                    file.WriteLine(password);
                    file.WriteLine(clientHome1); //written as 3rd line
                    file.WriteLine(path);
                    file.Close();
                }

            }
            else
            {
                MessageBox.Show("Please Select Valid Path", "My Application", MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            }
               
        }                                                    // event handler: click on "Select Folder"

        private void Form1_Load(object sender, EventArgs e)
        {
            panel1.Visible = true;
            panel1.Dock = DockStyle.Fill;
            panel4.Visible = false;
            panel4.Dock = DockStyle.None;
            try
            {
                if (File.Exists(saveTempFilesPath + "userCredentials.txt")) //file exits only when it is filled with credentials after 1st login (1st click on save button)
                {
                    string firstline = "";
                    StreamReader file = new StreamReader(saveTempFilesPath + "userCredentials.txt");
                    firstline = file.ReadLine();
                    if (firstline.Length > 2) //if file is there but not empty or having \n
                    {
                        username = firstline;
                        password = file.ReadLine();
                        clientHome1 = file.ReadLine();
                        clientHome2 = clientHome1.Replace("\\", "\\\\");
                        path = file.ReadLine();
                    }
                    file.Close();

                }
                else
                {
                    panel1.Visible = false;
                    panel1.Dock = DockStyle.None;
                    panel4.Visible = true;
                    panel4.Dock = DockStyle.Fill;
                }
            }
            catch (Exception dufbeui)
            {
                MessageBox.Show("Error reading user credentials. Enter your details together with Target Folder again");
            }
           
        }                                                                   // event handler: form load

        private void panel4_Paint(object sender, PaintEventArgs e)
        {

        }


        /// make files of the following strings tempToGenerateFilesToUploadToServer,tempToGenerateFOLDERToUploadToServer and send them to server.
        /// edit database after that..



    }
}
