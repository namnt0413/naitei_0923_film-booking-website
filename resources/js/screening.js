import $ from "jquery";

$("#screening").on("click", async function (e) {
    e.preventDefault();
    var date = $('#date').val();
    $.ajax({
        type: "GET",
        url: `/screenings/date/${date}`,
        success: function (data) {
            $('.list-screenings').empty()
            data.forEach((screening) => {
                let html = `
                    <a href="/screenings/${screening.id}" class="screening p-4 rounded-md border border-gray-200 grid grid-cols-4 gap-4 hover:shadow-lg">
                        <div class="h-full w-auto overflow-hidden rounded-md border border-gray-200 col-span-1">
                            <img src="${screening.film.medias.find((media) => media.type == "avatar").link}"
                                class="h-full w-auto object-cover object-center hover:grow hover:shadow-lg bg-cover m-auto"/>
                        </div>
                        <div class="ml-4 col-span-3">
                            <div class="film-description my-2">
                                <h3 class="film-name my-2 p-2">
                                    <b>${screening.film.title}</b>
                                </h3>
                                <p class="my-2 p-2">${screening.room.name}</p>
                            </div>
                            <div class="flex flex-1 items-end justify-between text-sm">
                                <div class="screen-time border border-orange-300 p-2">
                                    <p class="text-orange-600">${screening.startTime} - ${screening.endTime}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                $('.list-screenings').append(html)
            })
        },
    });
});
