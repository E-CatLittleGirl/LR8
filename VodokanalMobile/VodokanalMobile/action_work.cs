using System;
using System.Collections.Generic;
using System.Text;
using SQLite;

namespace VodokanalMobile
{
    [Table ("action_work")]
    public class action_work
    {
        [PrimaryKey, AutoIncrement, Column("_id")]
        public int id_action_work { get; set; }
        public int zayavka { get; set; }
        public DateTime start_of_work { get; set; }
        public DateTime approximate_finish_of_work { get; set; }
        public DateTime factical_finish_of_work { get; set; }
        public int workers { get; set; }
        public virtual workers Workers_rfkey { get; set; }
    }
}
