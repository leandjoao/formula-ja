const setCookie = (name, value, days) => {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
};

const getCookie = (name) => {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
};

const activeLGPD = () => {
    setCookie("LGPD_ACTIVE", true, 360);
    document.getElementById("LGPD_MODAL").remove();
};

const LGPD_MODAL = (after) => {
    if (!getCookie("LGPD_ACTIVE")) {
        let el = document.createElement("DIV");
        el.setAttribute("id", "LGPD_MODAL");
        el.innerHTML = `
        <div class="grid-x align-middle">
            <div class="cell">
                <b>Controle de Privacidade</b>
                <p>Utilizamos cookies para fornecer soluções personalizadas e proporcionar uma melhor experiência de navegação para você.</p>
            </div>
            <div class="cell">
                <div class="grid-x align-middle">
                    <div class="cell auto"><a href="/politica-de-privacidade" class="policity">Política de Privacidade</a></div>
                    <div class="cell shrink"><a href="javascript:void(0);" onclick="activeLGPD()" class="button">Ok</a></div>
                </div>
            </div>
        </div>`;
        after.parentNode.insertBefore(el, after.nextSibling);
    }
};
LGPD_MODAL(document.getElementById("structure-html"));
