const rawText = document.getElementById('data');
const lyricText = rawText.innerText.split(" "); //This should be directly from the API call because we will only load finished code w/ the correct highlighting,

let lyricMap = {};

function mapLyrics(lyricText) {
    for(let i = 0; i < lyricText.length; i++) {
        if(lyricMap[lyricText[i]] >= 1) {
            lyricMap[lyricText[i]]++;
        } else {
            lyricMap[lyricText[i]] = 1;
        }
    }
    return lyricMap;
}

//console.log(JSON.stringify(mapLyrics(lyricText)));

lyricText[1] = `<button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="3">${lyricText[1]}</button>`;


//console.log(lyricText.join(" "));
rawText.innerHTML = lyricText.join(" ");
// fetch('AFINN.json')
//   .then(function (response) {
//     return response.json();
//   })
//   .then(function (data) {
//     //console.log(JSON.stringify(data));
//     for(let key in data) {
//         console.log(data[key]);
//     }
//   })
//   .catch(function (err) {
//     console.log(err);
//   });