/*****//* (c) Copyright FacioCMS Maciej Dębowski 2021-today *//*****/
/*****/ 

console.log("%cWARNING!", "font-size: 100px; color: red;")
console.log("%cThis part of browser is Developer-only. Please don't paste any script here if you don't understand it. By executing scripts hackers could stole your APIToken which could be used to hack into your account or edit your page", "color: red; font-size: 40px;")
console.log(`%cMore informations about this: ${window.location.origin + window.location.pathname}docs/aboutxss.html`, 'color: red; font-size: 30px;')

console.log("%cWARNING! /\\", "font-size: 100px; color: red;")
console.log("%cNeed Help? Discord: https://discord.gg/QJCBtfbx", "color: #5865F2;")

const $ = _ => document.querySelector(_)
const $all = _ => document.querySelectorAll(_)
const request = (m, l, b) => { const x = new XMLHttpRequest(); x.open(m,l); x.send(b); return x; }

$(".cms-version i").innerHTML = `v. ${window._appData.version}` // VERSION

if(window.location.href.indexOf("#!") != -1) window.location.href = window.location.href.split("#!").join("")

// Utils functions (window.faciocms object)

window.faciocms = {
    prompt(text) {
        return new Promise(resolve => {
            $("#prompt-section").innerHTML += `<div class="prompt-box">
                <label for="prompt-box-input" class="label-prompt-box">${text}</label>
                <input id="prompt-box-input" type="text"> <button class="button-save-prompt"><em class="fas fa-check"></em></button>
            </div>`

            $(".button-save-prompt")
            .addEventListener("click", () => {
                resolve($("#prompt-box-input").value)
                $(".prompt-box").remove() 
            })

            $("#prompt-box-input")
            .addEventListener("keyup", e => {
                if(e.key == "Enter") {
                    resolve($("#prompt-box-input").value)
                    $(".prompt-box").remove() 
                }
            })
        });
    },

    keywordsToInput() {
        const newList = []
        $all(".keyword-item").forEach(a => newList.push(a.innerHTML))

        $("#keywords-meta-input").value = ""
        newList.forEach((item, index) => {
            $("#keywords-meta-input").value += `${item}${index != newList.length - 1 ? ',' : ''}`
        })
    }
}

// Other

function RouteChange(to) {
    document.body.innerHTML += `<form method="POST" style="display: none;">
        REDIRECTING
        <input type="text" name="route" value="${to}">
        <button id="click-send"></button>
    </form>`

    $("#click-send").click()
}

// Navbar redirect
$all(".redirect-nav-item")
.forEach(redirectNavItem => redirectNavItem.addEventListener("click", () => {
    RouteChange(redirectNavItem.dataset.route)
}))

// Route redirecting if home
if($("#routeid").innerHTML == "home") {
    RouteChange("Pages")
}

// Re-send form disable
if ( window.history.replaceState ) {
    //window.history.replaceState( null, null, window.location.href );
}

// API interaction
const APIUrl = `${window.location.origin}${window.location.pathname}versions/${window._appData.version}/api/`
const authToken = $("#authtoken").innerHTML

// Creating global page (API)
if($("#add-global-page")) {
    $("#add-global-page")
    .addEventListener("click", () => {
        const req = request("POST", `${APIUrl}createpage.php?authToken=${authToken}&parentid=-1`, '')
        req.addEventListener("readystatechange", () => {window.location.reload()})
    })

    $all(".btn-add-subpage").forEach(btnAdd => btnAdd.addEventListener("click", () => {
        const req = request("POST", `${APIUrl}createpage.php?authToken=${authToken}&parentid=${btnAdd.dataset.pageid}`, '')
        req.addEventListener("readystatechange", () => {
            console.log(req.responseText)
            window.location.reload()
        })
    }))

    $all(".btn-edit-page").forEach(btnEdit => btnEdit.addEventListener("click", () => {
        RouteChange(`pageedit:${btnEdit.dataset.pageid}`)
    }))
}

if($all(".btn-remove-page, .btn-removepage").length > 0) {
    $all(".btn-remove-page, .btn-removepage").forEach(btnRemove => btnRemove.addEventListener("click", () => {
        const req = request("POST", `${APIUrl}deletepage.php?authToken=${authToken}&id=${btnRemove.dataset.pageid}`, '')
        req.addEventListener("readystatechange", () => window.location.reload())
    }))
}

if($('[text-editor-for="pagecontent_send"]')) {
    $('[text-editor-for="pagecontent_send"]')
    .addEventListener("keyup", () => {
        $("#pagecontent_send").value = $('[text-editor-for="pagecontent_send"]').innerHTML
    })
}

if($(".btn-text-editor-tool")) {
    $all(".btn-text-editor-tool").forEach(btnTextEditorTool => btnTextEditorTool.addEventListener("click", () => {
        document.execCommand(btnTextEditorTool.dataset.command)
        $("#pagecontent_send").value = $('[text-editor-for="pagecontent_send"]').innerHTML
        return false
    }))
}

// Addon Save API Token
if($("#authtoken__api")) {
    $("#authtoken__api").value = authToken
}

// Adding addon
if($(".add-addon-key")) {
    $(".add-addon-key").addEventListener("click", async () => {
        const addonName = await window.faciocms.prompt("Name?: ")
        $(".addons-container-div")
        .innerHTML += `<div class="row-page-addon">
            <div class="row-page-addon-left">
                ${addonName}
            </div>
            <div class="row-page-addon-right">
                <input class="row-page-addon-input" value="" name="${addonName}" type="text">
            </div>
        </div>`

        $("#saveaddonsbutton").click()
        setTimeout(() => RouteChange($("#pageroute_name").value), 50)
    })
}

// Removing addon
$all(".link-remove-addon").forEach(removeAddonButton => {
    removeAddonButton.addEventListener("click", () => {
        removeAddonButton.href = `versions/${window._appData.version}/api/deleteaddon.php?apiauth=${authToken}&addonId=${removeAddonButton.dataset.addonid}`;
        setTimeout(() => RouteChange($("#pageroute_name").value), 50)
    })
})

if($(".remove-user-button-as-link")) {
    $all(".remove-user-button-as-link")
    .forEach(removeUserBtn => {
        removeUserBtn.href = `versions/${window._appData.version}/api/deleteuser.php?apiauth=${authToken}&userId=${removeUserBtn.dataset.userid}`
        removeUserBtn.addEventListener("click", () => setTimeout(() => {
            RouteChange("Users")
        }, 50))
    })
}

if($(".add-new-user-button")) {
    $(".add-new-user-button")
    .addEventListener("click", async () => {
        const username = await window.faciocms.prompt("Username: ?")
        const password = await window.faciocms.prompt("Password: ?")

        const xhr = request("GET", `${window.location.origin}${window.location.pathname}versions/${window._appData.version}/api/createuser.php?apiauth=${authToken}&user=${username}&password=${password}`, '')
        xhr.addEventListener("readystatechange", () => {
            RouteChange("Users")
        })
    })
}

if($("#keyword-add-input")) {

    function addKeyword(mode = 'normal') {
        const currentList = []
        $all(".keyword-item").forEach(a => currentList.push(a.innerHTML))

        let val = $("#keyword-add-input").value
        if(val == "") return
        if(currentList.includes (val)) return

        if(mode == 'decrement1') {
            val = val.substr(0, val.length - 1)
        }

        $("#keyword-add-input").value = ""
        $(".group-of-keywords")
        .innerHTML += `
            <div class="keyword-item" onclick="this.remove(); window.faciocms.keywordsToInput();">${val}</div>
        `

        window.faciocms.keywordsToInput()
    }

    $("#keyword-add-input")
    .addEventListener("keyup", e => {
        if(e.key == "Tab" || e.key == "Enter") {
            addKeyword()
        }
        else if(e.key == ",") {
            addKeyword("decrement1")
        }
    })

    $("#keyword-add-input")
    .addEventListener("keydown", e => {
        if(e.key == "Enter") {
            e.preventDefault()
            return false;
        }
    })
}

if($(".btn-delete-pernamently")) {
    $all(".btn-delete-pernamently").forEach(btnDeletePernamently => btnDeletePernamently.addEventListener("click", () => {
        window.open(`${window.location.href}versions/${window._appData.version}/api/pernamentlydeletepage.php?authtoken=${authToken}&id=${btnDeletePernamently.dataset.pageid}`, "_blank")
        setTimeout(() => window.location.reload(), 25)
    }))
}

if($(".btn-restore-page")) {
    $all(".btn-restore-page").forEach(btnDeletePernamently => btnDeletePernamently.addEventListener("click", () => {
        window.open(`${window.location.href}versions/${window._appData.version}/api/restorepage.php?authtoken=${authToken}&id=${btnDeletePernamently.dataset.pageid}`, "_blank")
        setTimeout(() => window.location.reload(), 25)
    }))
}

if($(".btn-start-updating")) {
    $(".btn-start-updating").addEventListener("click", () => {
        window.open(`${window.location.origin}${window.location.pathname}versions/${window._appData.version}/api/updater.php`)
    })
}

if($(".save-user-info")) {
    $(".save-user-info")
    .addEventListener("click", async () => {
        const currentPassword = await window.faciocms.prompt("Password?:")
        $("#oldpassword__user").value = currentPassword

        $(".profile-configurate").submit()
    })

    $("#username___form_user_info")
    .addEventListener("keydown", e => {
        if(e.key == "Enter") {
            e.preventDefault()
            return false
        }
    })
}