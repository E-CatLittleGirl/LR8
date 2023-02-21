using System;
using System.Collections.Generic;
using System.Text;
using SQLite;

namespace VodokanalMobile
{

    [Table("zayavky") ]
    public class zayavky
    {
        [PrimaryKey, AutoIncrement, Column("_id"), ]
        public int id_zayavky { get; set; }
        public string Info_message { get; set; }
        public DateTime Date { get; set; }
        public string Address { get; set; }
        public string district { get; set; }
        public string Actor { get; set; }
        public int code { get; set; }
        public int check_zayavka { get; set; }

    }
}
