using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace VodokanalMobile
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class OrderMainFlyout : ContentPage
    {
        public ListView ListView;

        public OrderMainFlyout()
        {
            InitializeComponent();

            BindingContext = new OrderMainFlyoutViewModel();
            ListView = MenuItemsListView;
        }

        class OrderMainFlyoutViewModel : INotifyPropertyChanged
        {
            public ObservableCollection<OrderMainFlyoutMenuItem> MenuItems { get; set; }

            public OrderMainFlyoutViewModel()
            {
                MenuItems = new ObservableCollection<OrderMainFlyoutMenuItem>(new[]
                {
                    new OrderMainFlyoutMenuItem { Id = 0, Title = "Заявки", IconSource = "order.png" , TargetType = typeof(Orders) },
                    new OrderMainFlyoutMenuItem { Id = 1, Title = "История", IconSource = "history.png" , TargetType = typeof(History) },
                    new OrderMainFlyoutMenuItem { Id = 2, Title = "Инфо СМС", IconSource = "infosms.png" , TargetType = typeof(InfoSMS) },
                    new OrderMainFlyoutMenuItem { Id = 3, Title = "Настройки", IconSource = "settings.png" , TargetType = typeof(Settings) },
                    new OrderMainFlyoutMenuItem { Id = 4, Title = "Выход", IconSource = "exit.png" , TargetType = typeof(Exit) },
                });
            }

            #region INotifyPropertyChanged Implementation
            public event PropertyChangedEventHandler PropertyChanged;
            void OnPropertyChanged([CallerMemberName] string propertyName = "")
            {
                if (PropertyChanged == null)
                    return;

                PropertyChanged.Invoke(this, new PropertyChangedEventArgs(propertyName));
            }
            #endregion
        }
    }
}