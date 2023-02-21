using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace VodokanalMobile
{
    public class OrderMainFlyoutMenuItem
    {
        public OrderMainFlyoutMenuItem()
        {
            TargetType = typeof(OrderMainFlyoutMenuItem);
        }
        public int Id { get; set; }
        public string Title { get; set; }

        public Type TargetType { get; set; }

        public string IconSource { get; set; }
    }
}