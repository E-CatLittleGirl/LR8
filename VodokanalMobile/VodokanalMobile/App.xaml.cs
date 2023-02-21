using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using System.Reflection;
using System.IO;

namespace VodokanalMobile
{
    public partial class App : Application
    {
        public const string DATABASE_NAME = "vodokanalmobile1.db";
        public static VodokanalAsyncRepository database;
        public static VodokanalAsyncRepository Database
        {
            get
            {
                if (database == null)
                {
                    string dbPath = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), DATABASE_NAME);
                    if (!File.Exists(dbPath))
                    {
                        var assembly = IntrospectionExtensions.GetTypeInfo(typeof(App)).Assembly;
                        using (Stream stream = assembly.GetManifestResourceStream($"VodokanalMobile.{DATABASE_NAME}"))
                        {
                            using (FileStream fs = new FileStream(dbPath, FileMode.OpenOrCreate))
                            {
                                stream.CopyTo(fs);  // копируем файл базы данных в нужное нам место
                                fs.Flush();
                            }
                        }
                    }
                    database = new VodokanalAsyncRepository(dbPath);
                }
                return database;
            }
        }

        public App()
        {
            InitializeComponent();

            //MainPage = new MainPage();

            MainPage = new Authorization();
        }

        protected override void OnStart()
        {
        }

        protected override void OnSleep()
        {
        }

        protected override void OnResume()
        {
        }
    }
}
