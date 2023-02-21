using System;
using System.Collections.Generic;
using System.Text;
using SQLite;
using Xamarin.Forms;

namespace VodokanalMobile
{
    [Table ("action_zayavka")]
    public class action_zayavka
    {
        [PrimaryKey, AutoIncrement, Column("_id")]
        public int id_action_zayavka { get; set; }
        public int zayavka { get; set; }
        public int status { get; set; }
        public DateTime date { get; set; }

        public virtual zayavky zayavky_rfkey { get; set; }

        public virtual Status status_rfkey { set; get; }

    }
}
