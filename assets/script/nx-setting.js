"use strict";function nxbb_ser_add(e){var t=document.querySelector("#"+e.id);t&&t.parentElement.classList.toggle("active")}function nxbb_api_show_hde(e){if(e){var t=e.parentElement.querySelector(".api-data-list");if(t){t.classList.toggle("active");var n=e.querySelector("h4.api-head");n&&n.classList.toggle("active")}}}document.querySelector(".nextbb-btncontrol-enable").addEventListener("click",function(){for(var e=document.querySelectorAll(".nxbb-event-enable"),t=0;t<e.length;t++)e[t].checked=!0}),document.querySelector(".nextbb-btncontrol-disable").addEventListener("click",function(){for(var e=document.querySelectorAll(".nxbb-event-enable"),t=0;t<e.length;t++)e[t].checked=!1});