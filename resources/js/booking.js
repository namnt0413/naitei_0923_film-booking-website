import $ from "jquery";

$("#room").on("change", async function (e) {
    let filmId = $("input[name='film_id'").val();
    $.ajax({
        type: "GET",
        url: `/seats/${e.target.value}/search`,
        success: function (data) {
            let selectSeat = $("#seat");
            selectSeat.empty();
            data.forEach((seat) => {
                let element = `<div class='col-span-1 flex flex-col justify-center items-center  w-32 h-auto gap-2'>
                    <input type='checkbox' name='seats[]' value='${seat["id"]}' id='${seat["id"]}-screening'>
                    <label for='${seat["id"]}-screening'>${seat["name"]}-${seat["type"]}</label>
                </div>`;
                selectSeat.append(element);
            });
        },
    });

    $.ajax({
        type: "GET",
        url: `/screenings/${e.target.value}/${filmId}/search`,
        success: function (data) {
            let selectScreening = $("#screening");
            selectScreening.empty();
            data.forEach((screening) => {
                let element = `<div class="flex gap-3">
                    <input name="screening_id" type="radio" value="${screening.id}" id="${screening.id}-screening" />
                    <label for="${screening.id}-screening">${screening.start_time}&nbsp&nbsp${screening.end_time}</label>
                </div>`;
                selectScreening.append(element);
            });
        },
    });

    $.ajax({
        type: "GET",
        url: `/rooms/${e.target.value}`,
        success: function (data) {
            $('.room-detail').empty()
            let html =
                `
                    <div class="p-2 text-center uppercase tracking-wide font-bold text-orange-800 text-xl">
                        ${data[0].name}
                    </div>
                    <div class="px-10 py-2 mb-10">
                        <img class="object-cover bg-cover m-auto h-auto w-full" src="${data[0].image}"/>
                    </div>
                `;

            $('.room-detail').prepend(html)
        },
    });
});
