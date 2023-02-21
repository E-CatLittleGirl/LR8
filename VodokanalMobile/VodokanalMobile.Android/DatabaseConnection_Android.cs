using Android.App;
using Android.Content;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using SQLite;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using VodokanalMobile.Droid;

[assembly: Xamarin.Forms.Dependency(typeof(DatabaseConnection_Android))]

namespace VodokanalMobile.Droid
{
    public class DatabaseConnection_Android : IDatabaseConnection
    {
        public SQLiteConnection DbConnection()
        {
            var dbName = "vodokanalmobile1.db";
            var path = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), dbName);
            return new SQLiteConnection(path);
        }
    }
}