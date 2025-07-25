* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    font-size: 17px;
}



.chapter {
    width: 25%;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
}

.content {
    width: 75%;
    padding: 30px;
    background-color: #ffffff;
}

/* thanh header  */
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffffff;
    border-bottom: 1px solid #ddd;

}

.logo-container img {
    max-width: 120px;
    height: auto;
    text-align: center;
}

/* Navigation Bar */
nav {
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 60px;
    left: 0;
    width: 100%;
    z-index: 1000;
}

.nav-title {
    flex: 1;
    text-align: center;
    color: #4f96e7;
    font-size: 1.2rem;
    margin: 0;
}

/* Toggle Button */
.button-toggle {
    display: flex;
    align-items: center;

}

.button {
    font-size: 15px;
    background: none;
    border: none;
    color: #75585D;
    cursor: pointer;
}

/* Logout Button */
.logout-btn {
    font-size: 16px;
    background-color: transparent;
    border: none;
    color: #4f96e7;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

.logout-btn:hover {
    color: #d9534f;
}



.navigation-links {
    margin-top: 20px;


}

a.nav-link,
a.start-quiz {
    padding: 7px 10px;
    margin-left: 40%;
    text-decoration: none;
    border-radius: 8px;
    font-size: 18px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(247, 251, 255, 0.07);
    display: inline-block;
    color: #fffcfc;
    background-color: #21a6ffff;
}

/* 
a.nav-link,
a.start-quiz:hover {
    background-color: rgb(156, 215, 255);
} */

a.nav-link {
    background-color: #21a6ffff;
    color: white;
}

nav {
    background-color: #fffcfc;
    display: flex;
    justify-content: space-between;
    padding: 20px;
    border: 1px solid #ddd;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    left: 0;
    z-index: 1000;
    width: 100%;
}

nav h3 {
    margin: 0;
    text-align: center;
    flex: 1;
    color: #4f96e7;
}

.button-toggle {
    display: flex;
    align-items: center;
}

.button {
    font-size: 20px;
    color: #4f96e7;
    border: 15px;
    border-radius: 5px;
}

.button:hover {
    color: #333;
}

.container {
    width: 1114px;
    height: 1207px;
    background: white;
    box-shadow: 1px 1px 50px -20px #7B98B4 inset;
    border-radius: 20px;
    border: 3px #EAEAEA solid;
    display: flex;
    padding-top: 6rem;
    justify-content: space-between;
    transition: all 0.3s ease-in-out;
    width: 100%;

}

.container {
    display: flex;
    flex-direction: row;
}

.chapter {
    width: 25%;
    padding: 10px;
    box-sizing: border-box;
    background-color: #f5f5f5;
}

.content {
    width: 75%;
    padding: 10px;
    box-sizing: border-box;
}


.chapter {
    background-color: #fffcfc;
    width: 430px;
    border-radius: 10px;
    overflow-y: auto;
    margin-top: 5px;
    margin-left: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border: 0.5px solid #e2e2e2;
}

.chapter a {
    display: block;
    margin-top: 5px;
    text-decoration: none;
    color: #4f96e7;
    margin-left: 10px;
    margin-right: 10px;
}

.chapter a:hover {
    color: #0b2f58;
    transform: scale(1.05);
}

.content {
    background-color: #fffcfc;
    width: 70%;
    margin-left: 3rem;
    margin-right: 1rem;
    border-radius: 20px;
    border: 0.5px solid #e2e2e2;
    transition: all 0.3s ease-in-out;
    width: 548px;
    height: 1207px;
    background: white;
    box-shadow: 1px 1px 50px -20px #7B98B4 inset;
    border-radius: 20px;
    border: 3px #EAEAEA solid;
}


.container.hide-chapter {
    justify-content: center;
}



.container.hide-chapter .content {
    width: 100%;
    justify-content: center;
    margin-left: 120px;
}



.main {
    text-align: left;
    margin: 5px;
    border: 0.5px solid #e2e2e2;
    height: 99.5%;
    border-radius: 20px;
    padding: 5px;
}

.main h3 {
    color: #4f96e7;
    margin-top: 6px;
}

.main p {
    margin-top: 10px;
}

.display {
    display: flex;
    justify-content: center;
    gap: 50px;
}

.display a {
    gap: 10px;
}

.select {
    display: flex;
    border: 1px solid #0e0d0d;
    text-decoration: none;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
    margin-bottom: 10px;
    align-items: center;
    width: 250px;
    justify-content: space-between;
    color: #4f96e7;


}



.space {
    width: 5%;
}


section {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background-color: #ffffff;
    width: 50%;
    border-radius: 20px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    padding: 5px;
    margin-bottom: 15px;
}

section:hover {
    transform: scale(1.05);
}

section a {
    text-decoration: none;
    color: #4f96e7;
    padding: 2px;
}

section a:hover {
    color: #0b2f58;
}

.text-container_left {
    text-align: right;
}

.text-container_right {
    text-align: left;
}

@media (max-width: 480px) {
    body {
        font-size: 14px;
    }

    nav {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    nav h3 {
        font-size: 14px;
    }

    .container {
        padding-top: 3.5rem;
    }

    .chapter {
        width: 100%;
    }

    .content {
        width: 100%;
        padding: 8px;


    }

    .main {
        padding: 8px;
    }
}


/* Mobile Responsive */
@media (max-width: 768px) {
    .nav-title {
        font-size: 1rem;
    }

    .header-top,
    nav {
        flex-direction: column;
        text-align: center;
    }

    .logout-btn {
        margin-top: 10px;
    }

    .button-toggle {
        justify-content: center;
        margin-top: 5px;
    }
}