# API-MAGANG
![Screenshot (7)](https://user-images.githubusercontent.com/42866630/60865678-bb010380-a250-11e9-9cf1-a1ff3eb7de5e.png)

🙉 **LOGIN (controller : Auth.php;model : MyModel.php;Pengisian data username & password diisi di body RAW)**\
   1.) POST (header => Auth-Key : geomedia;Content-Type : application/json)\
           **_ex.    username (ex. 198512052015032001)_**\
                  **_password (ex. 198512052015032001)_**\
   2.) POST (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
           **_ex.    username (ex. 198512052015032001)-**\\ 
                    password (ex. 198512052015032001)\
🙉 **PROFIL SKP (controller : Profil_SKP.php;model : Profil_model.php)**\
    1.) GET (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
    2.) PUT (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    log_id (ex. 198512052015032001)\
    3.) PUT FOTO (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
🙉 **LOG AKTIVITAS SKP (controller : Log_Aktivitas.php;model : Log_Aktivitas_model.php)**\
    1.) GET (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
    2.) DELETE (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    log_id (ex. 198512052015032001)\
    3.) POST (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
    4.) PUT (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
🙉 **LOG AKTIVITAS (controller : Log_Aktivitas.php;model : Log_Aktivitas_model.php)**\
    1.) GET (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
    2.) DELETE (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    log_id (ex. 198512052015032001)\
    3.) POST (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\
    4.) PUT (header => Auth-Key : geomedia;Content-Type : application/json;nip : 198512052015032001;Authorization : token)\
            *ex.    nip (ex. 198512052015032001)\

