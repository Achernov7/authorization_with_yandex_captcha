
export function showPopUp(popupValue) {
    let popup = document.createElement('div');
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.display = 'flex';
    popup.style.flexDirection = 'column';
    popup.style.justifyContent = 'center';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.fontSize = '30px';
    popup.style.width = '600px';
    popup.style.height = '400px';
    popup.style.borderRadius = '8px';
    popup.style.textAlign = 'center';
    popup.style.background = 'linear-gradient(#727acc, #ca6363)';
    document.body.append(popup);

    let popupValueWrap = document.createElement('div');
    popupValueWrap.style.display = 'flex';
    popupValueWrap.style.justifyContent = 'center';
    popupValueWrap.style.width = '100%';
    popupValueWrap.textContent = popupValue;
    popup.append(popupValueWrap);

    let btnWrap = document.createElement('div');
    btnWrap.style.display = 'flex';
    btnWrap.style.justifyContent = 'center';
    btnWrap.style.width = '100%';
    popup.append(btnWrap);


    let button = document.createElement('input');
    button.type = 'submit';
    button.value = 'Понятно';
    button.style.marginTop = '30px';
    button.style.borderRadius = '8px';
    button.style.width = '150px';
    button.style.height = '30px';

    btnWrap.append(button);

    button.addEventListener('click', () => {
        popup.remove();
    })
}