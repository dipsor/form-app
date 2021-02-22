import React, { useState } from 'react';
import axios from "axios";
import classNames from "classnames";

const GetStartedForm = () => {
    const [values, setValues] = useState({
        name: '',
        email: '',
        image: null
    });

    const [submitted, setSubmitted] = useState(false);
    const [showSuccess, setShowSuccess] = useState(false);
    const [errors, setErrors] = useState({})

    const handleNameInputChange = (event) => {
        event.persist();
        setValues((values) => ({
            ...values,
            name: event.target.value,
        }));
    };

    const handleEmailInputChange = (event) => {
        event.persist();
        setValues((values) => ({
            ...values,
            email: event.target.value,
        }));
    };

    const handleImageInputChange = (event) => {
        let files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        createImage(files[0]);
    };

    const createImage = (file) => {
          setValues((values) => ({
            ...values,
            image: file
        }))
    }

    const handleSubmit = (e) => {
        e.preventDefault();

        setSubmitted(true);

        let formData = new FormData();
        formData.append('name', values.name);
        formData.append('email',values.email);

        if (values.image !== null) {
            formData.append('image', values.image);
        }

        axios.post('get-started', formData)
            .then(response => {
                console.log(response)
                setShowSuccess(true);
                setSubmitted(false);
            })
            .catch(error => {
                setErrors(error.response.data.errors);
                setShowSuccess(false);
                setSubmitted(false);
            });
    };

    return (
        <div className="form-container">
            {submitted && <div className="spinner-container">
                <div className="spinner"/>
            </div>}

            {showSuccess &&
                <div className="success-container">
                    <h1>Thanks, {values.name}!</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            }
            {!showSuccess &&
            <div className="form-header">
                <h1>Get started</h1>
                <span className="note">* denotes a required field</span>
            </div>}

            {!showSuccess &&
            <form method="POST" onSubmit={handleSubmit}>
                <div className="form-row">
                    <label>What's your name?*
                        <p>Lorem ipsum dolor sit amet, lorem ipsum dolor.</p>
                        <input
                            name="name"
                            type="text"
                            className={classNames({
                                "form-control": true,
                                "error": errors.name
                            })}
                            placeholder="Jane Bloggs"
                            value={values.name}
                            onChange={handleNameInputChange}
                        />
                        {errors.name && <span className="error-message">{errors.name[0]}</span>}
                    </label>
                </div>

                <div className="form-row">
                    <label>Email address*
                        <p>Lorem ipsum dolor sit amet, lorem ipsum dolor.</p>
                        <input
                            name="email"
                            type="text"
                            className={classNames({
                                "form-control": true,
                                "error": errors.email
                            })}
                            value={values.email}
                            onChange={handleEmailInputChange}
                        />
                        {errors.email && <span className="error-message">{errors.email[0]}</span>}
                    </label>
                </div>

                <div className="form-row">
                    <label>Profile Photo
                        <p>Lorem ipsum dolor sit amet, lorem ipsum dolor.</p>
                        <input
                            name="image"
                            type="file"
                            className={classNames({
                                "form-control": true,
                                "error": errors.image
                            })}
                            // value={values.image}
                            onChange={handleImageInputChange}
                        />
                        {errors.image && <span className="error-message">{errors.image[0]}</span>}
                    </label>
                </div>

                <div className="form-row submit-container">
                    <button>Submit</button>
                </div>
            </form>}
        </div>
    );
}

export default GetStartedForm;
