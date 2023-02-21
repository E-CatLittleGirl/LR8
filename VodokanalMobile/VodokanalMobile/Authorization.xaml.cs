using SQLite;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Essentials;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using System.IO;
using System.Runtime.CompilerServices;

namespace VodokanalMobile
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class Authorization : ContentPage
    {
        // public const string DATABASE_NAME = "vodokanalmobile1.db";
        //static string dbPath = Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData), DATABASE_NAME);
        VodokanalAsyncRepository database = new VodokanalAsyncRepository();

        //ConfiguredTaskAwaitable 
       // public static VodokanalAsyncRepository database;
        public Authorization()
        {
            InitializeComponent();

        }

        //protected override async void OnAppearing()
        //{
        //    //Login.Text = App.Database.GetItemsWorkersAsync();

        //    await App.Database.GetItemsWorkersAsync();

        //    base.OnAppearing();
        //}

        public async void Enter_Clicked(object sender, EventArgs e)
        {

            var workers = (workers)BindingContext;
            //workers  workers = new workers();
            workers workers1 = database.GetItem(Login.Text);
            //var data = database.GetItemAsync(Login.Text);
            //var d1 = data.Where(x=> x.login == workers.login && x.password == workers.password).FirstOrDefaultAsync();
            //var w = (workers)BindingContext;
            //await App.Database.GetItemsWorkersAsync(w);


            if (workers1.password == Password.Text)
            {
                //OrderMain orderMain = new OrderMain();
                //NavigationPage.PushAsync(orderMain);
                // OrderMain = new NavigationPage(new OrderMain());
                //await App.Database.SaveItemWorkersAsync(workers);
                await Navigation.PushModalAsync(new OrderMain(), false);
            }
            else
            {
                DisplayAlert("Ой..", "Логин и пароль не верные!", "OK");
            }
        }
    }
}