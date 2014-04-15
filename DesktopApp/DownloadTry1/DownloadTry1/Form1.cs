﻿using System;
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
        string username = "";//= "abhishek";
        string password  = "";//= "anything";
        string clientHome1 = "";// "C:\\Users\\Abhishek Sen\\Downloads\\___SAANJHI";
        string clientHome2 = "";//"C:\\\\Users\\\\Abhishek Sen\\\\Downloads\\\\___SAANJHI";
        string tempToGenerateFile = "";
        string tempToGenerateFilesToUploadToServer = "";
        string tempToGenerateFOLDERToUploadToServer = "";

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
        //        Stream stream = webClient.OpenRead("http://localhost:9702/upload/DownloadQueue.txt");
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

        private int DownloadFromServer(string whereToDownloadFrom,string filePathOnClient)
        {
            try
            {
                WebClient wc = new WebClient();
                wc.DownloadFileCompleted += new AsyncCompletedEventHandler(FileDownloadCompleteTEMP);
                Uri url = new Uri(whereToDownloadFrom);
                wc.DownloadFileAsync(url, filePathOnClient + whereToDownloadFrom.Substring(whereToDownloadFrom.LastIndexOf('/') + 1));
                return 1;
            }
            catch
            {
                return -1;
            }

        }
        private int getQueueFromServer()
        {
            try
            {
                WebClient webClient = new WebClient();
                Stream stream = webClient.OpenRead("http://localhost:9702/upload/DownloadQueue.txt");
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
        }
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
            string uploadWebUrl = "http://localhost:9702/DesktopApp/upload.aspx";


            try
            {
                //MessageBox.Show(fullUploadFilePath);
                client.UploadFile(uploadWebUrl, fullUploadFilePath);
                return 1;
            }
            catch (Exception e)
            {
                MessageBox.Show(fullUploadFilePath);
                MessageBox.Show("Error in upload File to Server\n"+e.Message, "My Application",
                MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
                return -1;
            }
            //}


        }

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
        }

        private void Sync_Click(object sender, EventArgs e)
        {
            if(clientHome1!="")
            {
            System.IO.StreamWriter file = new System.IO.StreamWriter("status.txt");
            file.WriteLine("NewSync;"+username+";"+password);
            file.Close();
            WebClient client = new WebClient();
            //string fullUploadFilePath = @fileToOpen;
            string uploadWebUrl = "http://localhost:9702/DesktopApp/uploadStatus.aspx";
            try
            {
                client.UploadFile(uploadWebUrl, "status.txt");
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

        }

        private void DownloadStatusFile_Click(object sender, EventArgs e)
        {
            if (clientHome1 != "")
            {

                try
                {
                    WebClient webClient = new WebClient();
                    Stream stream = webClient.OpenRead("http://localhost:9702/DesktopApp/status.txt");
                    StreamReader streamReader = new StreamReader(stream);
                    string line, status = "No";
                    while ((line = streamReader.ReadLine()) != null)
                        status = line;
                    if (status == "ReadyToDownload")
                    {
                        string line1;
                        Stream stream1 = webClient.OpenRead("http://localhost:9702/DesktopApp/currentStatus.txt");
                        StreamReader streamReader1 = new StreamReader(stream1);

                        System.IO.StreamWriter file = new System.IO.StreamWriter("currentStatus.txt");
                        while ((line1 = streamReader1.ReadLine()) != null)
                        {
                            MessageBox.Show("hi");
                            string v = line1.Replace("!", "\\\\");
                            file.WriteLine(v);
                        }
                        file.Close();

                        System.IO.StreamReader fileToRead = new System.IO.StreamReader("currentStatus.txt");
                        while ((line = fileToRead.ReadLine()) != null && line.Length >2)
                        {
                            MessageBox.Show(line);
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
                                    string[] ext = columns[1].Split('.');
                                    int s = DownloadFromServer("http://localhost:9702/files/" + columns[0].ToString()+"."+ext[1], columns[2]);//file path
                                    if (s != 1)
                                    {
                                        MessageBox.Show("Download Failed!!\n" + columns[1] + " Could not be downloaded.");
                                    }
                                }
                            }

                        }
                    }
                    else
                    {
                        MessageBox.Show("Network Problem....Try again !!");
                    }
                }
                catch
                {
                    MessageBox.Show("Cannot download file");
                }

                DirectoryInfo tDir = new DirectoryInfo(@clientHome1);
                TraverseDirs(tDir);
                System.IO.StreamWriter fileStructure = new System.IO.StreamWriter("presentStructure.txt");
                tempToGenerateFile = tempToGenerateFile.Replace("\\", "\\\\");
                fileStructure.WriteLine(tempToGenerateFile);
                fileStructure.Close();
                tempToGenerateFile = tempToGenerateFile.Replace("\\\\", "\\");
                generateFilesToUploadToServerandUploadThem();
                //this.Close();

            }//ifclose
            else
            {
                MessageBox.Show("Please Select Target Folder first");
            }
                    
        }

       
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

        private void generateFilesToUploadToServerandUploadThem()
        {
            string line1,line2;
            System.IO.StreamReader readCurrent = new System.IO.StreamReader("presentStructure.txt"); // on client
            while ((line1 = readCurrent.ReadLine()) != null)
            {
                if (line1.Length > 2)
                {
                    int flag = 0;
                    string[] columns1 = line1.Split(';');
                    System.IO.StreamReader readPresent = new System.IO.StreamReader("currentStatus.txt");// on server
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
                        if (!columns1[0].StartsWith("dwalin")) //if it is folder
                        {
                            string t = columns1[1] + columns1[0];
                            t = t.Replace("\\\\", "\\");
                            MessageBox.Show(clientHome1 + t);
                            uploadFileToServer(clientHome1 + t); //upload File To Server
                            tempToGenerateFilesToUploadToServer = tempToGenerateFilesToUploadToServer + columns1[0] + ";" + columns1[1] + ";" + "0" + "\n";
                        }
                        else
                            tempToGenerateFOLDERToUploadToServer = tempToGenerateFOLDERToUploadToServer + columns1[0] + ";" + columns1[1] + ";" + "1" + "\n";
                    }
                }
            }

            StreamWriter filefromc2s = new StreamWriter("xtrafiles2beadded2server.txt");
            filefromc2s.WriteLine(tempToGenerateFilesToUploadToServer); // one extra \n
            filefromc2s.WriteLine("`");
            filefromc2s.WriteLine(tempToGenerateFOLDERToUploadToServer);
            filefromc2s.Close();

            WebClient client = new WebClient();
            string uploadWebUrl = "http://localhost:9702/DesktopApp/XtraFilesFromClient2Server.aspx";
            try
            {
                client.UploadFile(uploadWebUrl, "xtrafiles2beadded2server.txt");
            }
            catch (Exception )
            {
                MessageBox.Show("Error in Uploading to Server", "My Application",
                MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            }


        }

        private void button1_Click(object sender, EventArgs e) //save
        {
             username = txtBoxUsername.Text;
             password = txtBoxPassword.Text;
             if (username == "" || password == "")
             {
                 MessageBox.Show("Please Fill Proper credentials");
             }
             else
             {
                 StreamWriter file = new StreamWriter("userCredentials.txt");
                 file.WriteLine(username);
                 file.WriteLine(password);
                 file.Close();
          
                 //verify
                // curUser.Text = username + " is Logged In";
             }
        }

        private void lblSettings_Click(object sender, EventArgs e)
        {
            if (lblSettings.Text == "Connection Settings")
            {
                lblSettings.Text = "Back";
                panel1.Visible = false;
                panel4.Visible = true;
                panel4.Dock = DockStyle.Fill;
                txtBoxUsername.Text = username;
                txtBoxPassword.Text = password;
            }
            else
            {
                lblSettings.Text = "Connection Settings";
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


            
            
        }

        private void button2_Click(object sender, EventArgs e)
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
            }
            else
            {
                MessageBox.Show("Please Select Valid Path", "My Application", MessageBoxButtons.OKCancel, MessageBoxIcon.Asterisk);
            }
               
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            panel1.Visible = true;
            panel1.Dock = DockStyle.Fill;
            panel4.Visible = false;
            panel4.Dock = DockStyle.None;
        }

        private void panel4_Paint(object sender, PaintEventArgs e)
        {

        }


        /// make files of the following strings tempToGenerateFilesToUploadToServer,tempToGenerateFOLDERToUploadToServer and send them to server.
        /// edit database after that..



    }
}
