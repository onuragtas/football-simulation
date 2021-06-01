var main = {
    week: 1,
    playedCurrentWeek: false,
    ready: function () {
        this.getTeams()
        this.getMatchesOfWeek($("#next-btn"))
    },

    getTeams: function () {
        $.ajax({
            type: "GET",
            url: "/api/teams",
            data: {},
            success: function (response) {
                $("#predictions-table").find('tbody').html("")

                let html = '';

                $.each(response.data[0], function (index, value) {
                    if (response.data[1] > 0){
                        $("#predictions").show();
                    }else{
                        $("#predictions").hide();
                    }
                    $("#predictions-table").find('tbody').append("<tr><td>"+value.name+"</td><td>"+(value.point*100/response.data[1]).toFixed(2)+"</td></tr>>")

                    html += '<tr>'
                    html += '<td>' + value.name + '</td>'
                    html += '<td>' + value.pts_point + '</td>'
                    html += '<td>' + value.matches + '</td>'
                    html += '<td>' + value.wins + '</td>'
                    html += '<td>' + value.losses + '</td>'
                    html += '<td>' + value.draws + '</td>'
                    html += '<td>' + value.goal_difference + '</td>'
                    html += '</tr>'
                });

                $("#teams-table").find('tbody').html(html)
            },
            error: function () {
            },
            complete: function () {
            }
        });
    },

    getMatchesOfWeek: function (btn) {
        let that = this
        btn.html("Loading...")
        btn.css({opacity: 0.7, pointerEvents: 'none'})
        $.ajax({
            type: "GET",
            url: "/api/week/" + this.week,
            data: {},
            success: function (response) {
                if (response.data.length === 0 && that.week <= 6) {
                    that.week += 1;
                    that.getMatchesOfWeek(btn)
                } else {
                    let html = '';
                    $.each(response.data, function (index, value) {
                        html += '<tr id="matchs-' + index + '">'
                        html += '<td>' + value.hostName + '</td>'
                        html += '<td> - </td>'
                        html += '<td>' + value.awayName + '</td>'
                        html += '</tr>'
                    });

                    $("#match-result-table").find('tbody').html(html)
                }
            },
            error: function () {
            },
            complete: function () {
                $("#next-btn").addClass("disabled")
                btn.html("Show Next Week")
                btn.css({opacity: 1, pointerEvents: 'all'})
            }
        });
    },
    playMatch(btn) {
        if (this.playedCurrentWeek){
            return false;
        }

        let that = this
        btn.html("Loading...")
        btn.css({opacity: 0.7, pointerEvents: 'none'})
        $.ajax({
            type: "GET",
            url: "/api/play_match/" + this.week,
            data: {},
            success: function (response) {
                that.playedCurrentWeek = true;
                $.each(response.data, function (index, value) {
                    $("#match-result-table")
                        .find('tbody')
                        .find("tr#matchs-"+index)
                        .find("td:eq(1)")
                        .text(value.hostGoal + ' - ' + value.awayGoal)
                });

                that.getTeams()
            },
            error: function () {
            },
            complete: function () {
                $("#next-btn").removeClass("disabled")
                btn.html("Play")
                btn.css({opacity: 1, pointerEvents: 'all'})
            }
        });
    },
    loadNextWeek(btn) {
        if (this.playedCurrentWeek) {
            this.week += 1;
            this.getMatchesOfWeek(btn)
            this.playedCurrentWeek = false
        }
    }
};
