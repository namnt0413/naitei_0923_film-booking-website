import $ from "jquery";

// function checkSeatType(type, $returnedColor) {
//     switch (type) {
//         case "normal":
//             // returnedColor=""
//     }
// }

$("#room").on("change", async function (e) {
    let filmId = $("input[name='film_id'").val();

    $.ajax({
        type: "GET",
        url: `/screenings/${e.target.value}/${filmId}/search`,
        success: function (data) {
            let selectScreening = $("#screening");
            selectScreening.empty();
            data.forEach((screening) => {
                let element = `<div class=" flex gap-3">
                    <input name="screening_id" type="radio" class="screening accent-orange-700" value="${screening.id}" id="screening" />
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

    $("#screening").on("click", async function (event) {
        $.ajax({
            type: "GET",
            url: `/seats/${e.target.value}/search`,
            success: function (data) {
                let roomSeat = data;
                console.log(e.target.value , event.target.value)

                $.ajax({
                    type: "GET",
                    url: `/seats/${e.target.value}/${event.target.value}/search`,
                    success: function (data) {
                        let selectSeat = $("#seat");
                        selectSeat.empty();

                        let selectedSeat = data
                        console.log(selectedSeat)
                        roomSeat.forEach((seat) => {
                            let disabled="";
                            selectedSeat.map( item => {
                                if (item["id"] === seat["id"]) disabled="disabled"; return disabled;
                            })
                            let element = `<div class='col-span-1 flex flex-col justify-center items-center w-32 h-auto gap-2'>
                                <input type='checkbox' name='seats[]' value='${seat["id"]}' id='${seat["id"]}-screening' value=""
                                    ${disabled} ${disabled == "disabled" ? "checked" : ""}
                                    class='w-20 h-8 ${seat["type"]} ${disabled} ${disabled == "disabled" ? "disabled" : ""}'
                                >
                                <label for='${seat["id"]}-screening' class="${seat["type"]} ${disabled} ${disabled == "disabled" ? "disabled" : ""}">
                                    ${seat["name"]}-${seat["type"]}
                                </label>
                            </div>`;
                            selectSeat.append(element);
                        });
                    },
                });
            },
        });
    });

});
