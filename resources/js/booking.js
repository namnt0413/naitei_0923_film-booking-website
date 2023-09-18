import $ from "jquery";

$("#room").on("change", async function (e) {
    $.ajax({
        type: "GET",
        url: `/seats/${e.target.value}/search`,
        success: function (data) {
            let selectSeat = $("#seat");
            selectSeat.empty();
            data.forEach((seat) => {
                let element = `<div class='flex flex-col justify-center items-center w-fit h-fit'>
                    <input type='radio' name='seat_id' value='${seat["id"]}' id='${seat["id"]}-screening'>
                    <label for='${seat["id"]}-screening'>${seat["number"]}-${seat["type"]}</label>
                </div>`;
                selectSeat.append(element);
            });
        },
    });

    $.ajax({
        type: "GET",
        url: `/screenings/${e.target.value}/search`,
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
});
