var KANDIDAT = new Array();
(function($) {
    $(window).load(function() {

        $("#pilih").click(function() {
            $("#modalHasil").html("");
            $('#myModal').modal('toggle');
        });

        $("#txtCariKandidat").keyup(function() {
            var filter = $("#txtFilterKandidat").val();
            var key = $("#txtCariKandidat").val();
            //alert(filter + "-"+key);
            $.ajax({
                url: "LAB-FMCDM-Kandidat_proses.php",
                type: "POST",
                data: "filter=" + filter + "&key=" + key,
                cache: false,
                beforeSend: function() {
                    // $("#modalHasil").attr("align", "center");
                    //$("#modalHasil").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
                },
                success: function(data) {
                    $("#modalHasil").html("");
                    var user = data.split("#");
                    var html = "";
                    for (var i in user) {
                        var user_nilai = user[i].split("|");
                        html = "<tr>";
                        html = html + "<td><label class='checkbox'><input type='checkbox' data-id='" + user_nilai[0] + "' data-foto='" + user_nilai[1] + "' data-nama='" + user_nilai[2] + "'></label></td>";
                        html = html + "<td><img src='" + user_nilai[1] + "' class='img-circle' width='30' heigth='30'/></td>";
                        html = html + "<td>" + user_nilai[2] + "</td>";
                        html = html + "<td>" + user_nilai[3] + "</td>";
                        html = html + "</tr>";
                        $(html).slideDown("slow").appendTo("#modalHasil");
                    }
                }
            });
        });

        $("#cmdPilih").click(function() {
            $("#modalHasil input[type=checkbox]:checked").each(function() {
                //KANDIDAT = KANDIDAT + ($(this).val()); 
                var id_val = $(this).attr("data-id");
                var foto_val = $(this).attr("data-foto");
                var nama_val = $(this).attr("data-nama");
//               var kandidat_val = {'id':id_val,'foto':foto_val,'nama':nama_val};
                var kandidat_val = id_val + "|" + foto_val + "|" + nama_val;
                //alert($.inArray(kandidat_val,KANDIDAT));
                if ($.inArray(kandidat_val, KANDIDAT) == -1) {
                    KANDIDAT.push(kandidat_val);
                    //var calon = ""; 
                    var calon = "<tr data='" + kandidat_val + "'>";
                    calon = calon + "<td><img src='" + foto_val + "' class='img-circle' width='70' height='70'></td>";
                    calon = calon + "<td>" + nama_val + "</td>";
                    calon = calon + "</tr>";
                    $(calon).prependTo("#daftarCalon");
                }
            });
            $("#content_1").mCustomScrollbar("destroy");
            $("#content_1").mCustomScrollbar({
                scrollButtons: {
                    enable: true
                },
                theme: "dark-thin"
            });
        });

        $("#cmdAnalisis").click(function() {
            $("#hasil_analisis").html("");
            var data = "";
            $("#daftarCalon tr").each(function() {
                data = data + $(this).attr("data") + "#";
            });
            data = data.substr(0, data.length - 1);
            //proses tahap ke-1
            $.ajax({
                url: "LAB-FMCDM-analisis_proses1.php",
                type: "POST",
                data: "calon=" + data,
                cache: false,
                beforeSend: function() {
                     $("#hasil_analisis").attr("align", "center");
                    $("#hasil_analisis").html("<img src='img/loading.gif'></br>Sedang Memuat Proses Analisa Tahap ke-1, Harap Tunggu..</img>");
                },
                success: function(html) {
                   $("#hasil_analisis").html("slow").html(html);
                    
                }
            });
            //proses tahap ke-2
            /*
            $.ajax({
                url: "LAB-FMCDM-analisis_proses2.php",
                type: "POST",
                data: "calon=" + data,
                cache: false,
                beforeSend: function() {
                     $("#hasil_analisis").attr("align", "center");
                    $("#hasil_analisis").appendTo("<img src='img/loading.gif'></br>Sedang Memuat Proses Analisa Tahap ke-2, Harap Tunggu..</img>");
                },
                success: function(html) {
                   $("#hasil_analisis").fadeIn("slow").appendTo(html);
                    
                }
            });*/
        });

    });
})(jQuery);
