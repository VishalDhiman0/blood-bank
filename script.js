const sampleRequest = (event) => {
  const xmlHttp = new XMLHttpRequest();
  bloodSampleId = event.target.id;
  xmlHttp.open("POST", "/assignment/api/request-sample.php");

  const target = event.target;

  target.disabled = true;
  target.innerHTML = "Requesting";

  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlHttp.onreadystatechange = function (ev) {
    if (xmlHttp.readyState == 4) {
      target.disabled = false;
      if (xmlHttp.status == 200) {
        document.location.reload();
      } else {
        alert(
          `Something went wrong please try again Response Code [${xmlHttp.statusText}: ${xmlHttp.status}]`
        );
      }
    }
  };

  xmlHttp.send(`bloodSampleId=${bloodSampleId}`);
};

const requestBtns = document.getElementsByClassName("request-btn");
console.log(requestBtns);

for (let i = 0; i < requestBtns.length; i++) {
  console.log(requestBtns[i]);
  requestBtns[i].onclick = sampleRequest;
}

function disableActiveLink() {
  var link = window.location.href;

  var allLinks = document.getElementsByTagName("a");

  for (var i = 0; i < allLinks.length; i++) {
    var cur = allLinks[i];

    if (cur.href == link) {
      cur.classList.add("disabled");
      cur.classList.add("disabled-own");
    }
  }
}

disableActiveLink();
