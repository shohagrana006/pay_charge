// variable generating function start

// single element by queryselector
const querySelectorElement = (className) => {
    return document.querySelector(`.${className}`);
};

// multiple element by queryselector all
const querySelectorAllElement = (className) => {
    return document.querySelectorAll(`.${className}`);
};

// single element by className
const classNameElement = (className) => {
    return document.getElementsByClassName(`${className}`);
};

// single element by id
const idElement = (idName) => {
    return document.getElementById(`${idName}`);
};

// variable generating function end

// variable by id start
let elem = document.documentElement;
const sideBar = idElement("sideContent");
const mainContent = idElement("mainContent");
const totalIcon = idElement("totalIcon");
const openFullScreen = idElement("openFullScreen");
const closeFullScreen = idElement("closeFullScreen");
const inputPassword = idElement("exampleInputPassword1");
const selectSearch = idElement("selectSearch")
    // variable by id end

// variable by class begin
const selectMultiple = querySelectorElement("select-multiple");
const toastBodyItem = querySelectorElement("toastBodyItem");
const toastBodyItem2 = querySelectorElement("toastBodyItem2");
const toastBodyItem3 = querySelectorElement("toastBodyItem3");
const faAngleUp = querySelectorElement("fa-angle-up");
const angle2 = querySelectorElement("angle2");
const angle3 = querySelectorElement("angle3");
const loader = querySelectorElement("preloader");
const fanAction = querySelectorElement("fanAction");
const activeBg = querySelectorElement("activeBg");
let social_count = querySelectorAllElement("social_count");
let searchedItems = querySelectorAllElement("searchedItem");
let currency = querySelectorAllElement("currency");
let side_bar_lists = querySelectorAllElement("side_bar_list");
const header = querySelectorElement("header_sub_content");
const iconContainer = querySelectorElement("all-icon-container");
const pages = querySelectorAllElement("pages");
const filter = querySelectorElement("filter-form-container");
const hidePass = querySelectorElement("hidePass");
const showPass = querySelectorElement("showPass");
let customCheckboxes = querySelectorAllElement("custom-checkbox");
let checkboxButton = querySelectorElement("checkbox-button");
let selectedValueContainer = querySelectorElement("selectedValues");
let searchSelectedValue = querySelectorElement("searchSelectedValue");
let dashboardLocation = window.location.pathname;
let checkBoxHeader = querySelectorAllElement("check-box-header");
// variable by class end

// static variable start
let time = 300;
const eachLi = 40.2;
// static variable end

// side bar visible function begin
const showSideBar = () => {
    sideBar.classList.toggle("marginLeft");
    mainContent.classList.toggle("added");
    header.classList.toggle("header-remain-width");
};
// side bar function end
// sidebar active menu function begin
side_bar_lists.forEach((singleSideBar) => {
    singleSideBar.addEventListener("click", () => {
        singleSideBar.children[1].classList.toggle("rotate180");
        if (singleSideBar.children[1].classList.contains("rotate180")) {
            console.log(singleSideBar.parentElement.children[1]);
            side_bar_lists.forEach((single) => {
                single.parentElement.children[1].style.height = "0px";
                single.children[1].classList.remove("rotate180");
            });

            singleSideBar.parentElement.children[1].style.height =
                singleSideBar.parentElement.children[1].children.length * eachLi + "px";
            singleSideBar.children[1].classList.add("rotate180");
        } else {
            singleSideBar.parentElement.children[1].style.height = "0px";
        }
    });
});
// sidebar active menu end

// active after reload function begin
if (pages) {
    pages.forEach((page) => {
        if (page.getAttribute("data-target")) {
            console.log(page.getAttribute("data-target"))
            if (dashboardLocation.includes(page.getAttribute("data-target"))) {
                if (page.parentElement.parentElement.parentElement.children[0].children[1]) {
                    page.parentElement.parentElement.parentElement.children[0].children[1].classList.add(
                        "rotate180"
                    );
                }
                page.parentElement.parentElement.style.height = page.parentElement.parentElement.children.length * eachLi + "px";
                page.classList.add("text--primary")
                page.parentElement.parentElement.scrollIntoView({ block: 'center' })
            }
        }
    });
}
// active after reload function end

// checkboxes expand and collaps begin
if (checkBoxHeader) {
    checkBoxHeader.forEach(checkbox => {
        checkbox.addEventListener("click", () => {
            checkbox.parentElement.parentElement.children[1].classList.toggle("d-none");
            checkbox.classList.toggle("rotate180");
        })
    })
}

// full screen function start
const openFull = () => {
    openFullScreen.style.display = "none";
    closeFullScreen.style.display = "block";
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
    }
};
const closeFull = () => {
    closeFullScreen.style.display = "none";
    openFullScreen.style.display = "block";
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
};
// select multiple function area begin 
let selectedItems = [];
const testfunction = (arr) => {
    let selectedItemsBox = querySelectorElement("selectedItemsBox");
    selectedItemsBox.innerHTML = "";
    arr.map((item) => {
        let div = document.createElement("div");
        div.classList.add("me-2");
        div.innerHTML = `<span class="border rounded px-2 remove-selected-item">
        <i onclick=removeSelectedItem(this) class="fas fa-times pointer removeItem pe-2 border-end text-danger"></i>
        <span class="ps-2">${item}</span>
      </span>`;
        selectedItemsBox.appendChild(div);
    });
};
const selectMultipleItems = () => {
    if (selectedItems.indexOf(selectMultiple.value) === -1) {
        selectedItems.push(selectMultiple.value);
        testfunction(selectedItems);
    } else {
        let indexItems = selectedItems.indexOf(selectMultiple.value);
        selectedItems.splice(indexItems, 1);
        testfunction(selectedItems);
    }
};
const removeSelectedItem = (item) => {
        let num = item.parentElement.children[1].innerText
        let indexItems = selectedItems.indexOf(num);
        selectedItems.splice(indexItems, 1);
        testfunction(selectedItems);
    }
// sweet alert area begin
const basicAlert = () => {
    Swal.fire("Any fool can use a computer");
};
const titleAndText = () => {
    Swal.fire("The Internet?", "That thing is still around?", "question");
};
const errorAlert = () => {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>',
    });
};
const customAlert = () => {
    Swal.fire({
        title: "<strong>HTML <u>example</u></strong>",
        icon: "info",
        html: "You can use <b>bold text</b>, " +
            '<a href="//sweetalert2.github.io">links</a> ' +
            "and other HTML tags",
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
        confirmButtonAriaLabel: "Thumbs up, great!",
        cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
        cancelButtonAriaLabel: "Thumbs down",
    });
};
const multipleOption = () => {
    Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Saved!", "", "success");
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
};
const topRight = () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
};
const topLeft = () => {
    Swal.fire({
        position: "top-start",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
};
const bottomLeft = () => {
    Swal.fire({
        position: "bottom-start",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
};
const bottomRight = () => {
    Swal.fire({
        position: "bottom-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
};
const centerAlert = () => {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
};
const confirmAlert = () => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
};
const confirmCancelAlert = () => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        })
        .then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    "Deleted!",
                    "Your file has been deleted.",
                    "success"
                );
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)",
                    "error"
                );
            }
        });
};
const imageAlert = () => {
    Swal.fire({
        title: "Sweet!",
        text: "Modal with a custom image.",
        imageUrl: "https://static9.depositphotos.com/1719616/1205/i/600/depositphotos_12057489-stock-photo-sunflower-field.jpg",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image",
    });
};
const backgroundAlert = () => {
    Swal.fire({
        title: "Custom width, padding, color, background.",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(/images/trees.png)",
        backdrop: `
      rgba(0,0,123,0.4)
      url("https://sweetalert2.github.io/images/nyan-cat.gif")
      left top
      no-repeat
    `,
    });
};
const toaster = () => {
    let timerInterval;
    Swal.fire({
        title: "Auto close alert!",
        html: "I will close in <b></b> milliseconds.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        },
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
};
const ajaxAlert = () => {
    Swal.fire({
        title: "Submit your Github username",
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Look up",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(`//api.github.com/users/${login}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch((error) => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url,
            });
        }
    });
};
const toaster001 = (icon, message, position) => {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icon,
        title: message
    })
}

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// hide and show password from login page area begin 
const hidePassword = () => {
    inputPassword.type = 'password';
    hidePass.classList.add("d-none");
    showPass.classList.remove("d-none")
}
const showPassword = () => {
        inputPassword.type = 'text';
        showPass.classList.add("d-none");
        hidePass.classList.remove("d-none")
    }
    // hide and show password from login page area begin 

// select search function area begin 
if (selectSearch !== null) {
    selectSearch.addEventListener("click", () => {
        selectedValueContainer.style.display = 'block'
    })
    searchedItems.forEach(item => {
        item.addEventListener("click", () => {
            selectedValueContainer.style.display = 'none';
            selectSearch.value = item.innerText;
            searchSelectedValue.value = ""
            searchedItems.forEach(item => {
                item.classList.remove('d-none')
            })
        })
    })
}

const searchSelectedValueFunction = () => {
    searchedItems.forEach(item => {
        item.classList.add('d-none')
        if (item.innerText.toLowerCase().includes(searchSelectedValue.value.toLowerCase()) && searchSelectedValue.value.length > 0) {
            item.classList.remove('d-none');
        } else if (searchSelectedValue.value.length === 0) {
            item.classList.remove('d-none')
        }
    })
}

// select search function area end 
if (customCheckboxes) {
    customCheckboxes.forEach(customCheckbox=>{
        customCheckbox.addEventListener("click", () => {
            checkboxButton.classList.toggle("checkbox-button-toggle")
            customCheckbox.classList.toggle("border-danger")
        })
    })
}



// item delete function start

// delete a specific item
$(document).on('click', '.sweet-delete', function(e) {
    e.preventDefault();
    const deletedId = $(this).attr('id');
    const route = $(this).attr('data-route');
    sweatDelete(route, deletedId)
});
//deleted sweat alert
function sweatDelete(route, deletedId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                "id": deletedId,
            };
            deleteItem(route, data)
        }
    })
}

// delete language function
function deleteItem(route, data) {
    
    $.ajax({
        type: "post",
        url: route,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                responseSweatAlert('Deleted', response.message, 'success')
            } else {
                responseSweatAlert('Not Deleted', response.message, 'error')
            }
        }
    });
}

//response sweat alert
function responseSweatAlert(header, message, type) {
    Swal.fire(
        header,
        message,
        type
    )
    .then((response) => {
        location.reload();
    });
}


// check uncheck function
function checkUncheckMethod(type,selector,status){
    if(type == 'class'){
        $(`.${selector}`).prop('checked', status)
    }
    else{
        $(`#${selector}`).prop('checked', status)
    }
}


//single image preview js
const imagePreview = (file, id, className = 'preview-image') => {
        $(`#${id}`).append(
            `<img alt='${file.type}'class='mt-2 ${className} img-thumbnail me-2 f-left' src='${URL.createObjectURL(file)}'>`
        );
    }
    //empty ionput filed js
const emptyInputFiled = id => {
    $(`#${id}`).html('');
}

