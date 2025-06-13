import { useRef } from "react";
import { PlusIcon, TrashIcon } from "./IconCompt"

export const ModalEl = ({ setTitle, title, submitForm }) => {
    return (

        <div
            className="modal fade"
            id="exampleModal"
            tabIndex={-1}
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog">
                <div className="modal-content">
                    <div className="modal-header">
                        <h1 className="modal-title fs-5" id="exampleModalLabel">
                            Form
                        </h1>
                        <button
                            type="button"
                            className="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        />
                    </div>
                    <div className="modal-body border ">

                        <div className='container'>
                            <div className="mb-3">
                                <label htmlFor="exampleInputEmail1" className="form-label">
                                    Judul
                                </label>
                                <input
                                    type="text"
                                    value={title}
                                    onChange={(e) => setTitle(e.target.value)}
                                    name='title'
                                    className="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                />
                            </div>
                        </div>
                    </div>
                    <div className="modal-footer">
                        <button
                            type="button"
                            className="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button onClick={() => submitForm()} type="button" className="btn btn-primary" data-bs-dismiss="modal">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    )
}


export const ModalDesignEl = ({ handleClear, formRef, handleSubmitDesign, handleChange, formDesign, handleChangeOptions, handleDeleteOptions, addOptions }) => {


    return (
        <div
            className="modal fade"
            id="staticBackdrop1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabIndex={-1}
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog">
                <div className="modal-content">
                    <form ref={formRef} action="" onSubmit={handleSubmitDesign}>
                        <div className="modal-header">
                            <h1 className="modal-title fs-5" id="staticBackdropLabel">
                                Form create question
                            </h1>
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                                onClick={() => handleClear()}
                            />
                        </div>
                        <div className="modal-body ">

                            <>

                                <div className="mb-3">
                                    <label htmlFor="label1" className="form-label">
                                        Label
                                    </label>
                                    <input
                                        required
                                        type="text"
                                        onChange={handleChange}
                                        name='label'
                                        className="form-control"
                                        id="label1"
                                    />
                                </div>
                                <div className="mb-3">
                                    <label htmlFor="label1" className="form-label">
                                        Description
                                    </label>
                                    <input
                                        required
                                        type="text"
                                        onChange={handleChange}
                                        name='description'
                                        className="form-control"
                                        id="label1"
                                    />
                                </div>

                                <div className="mb-3 ">
                                    <label htmlFor="ssds" className="form-label">
                                        Type :
                                    </label>
                                    <div className="form-check">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            onChange={handleChange}
                                            name="type"
                                            value="checkbox"
                                            id="flex-dinamis1"
                                        />
                                        <label className="form-check-label" htmlFor="flex-dinamis1">
                                            checkbox
                                        </label>
                                    </div>
                                    <div className="form-check">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            onChange={handleChange}
                                            name="type"
                                            value="radio_button"
                                            id="flex-dinamis2"
                                        />
                                        <label className="form-check-label" htmlFor="flex-dinamis2">
                                            radio_button
                                        </label>
                                    </div>
                                    <div className="form-check">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            onChange={handleChange}
                                            name="type"
                                            id="flex-dinamis3"
                                            value="long_text"

                                        />
                                        <label className="form-check-label" htmlFor="flex-dinamis3">
                                            long_text
                                        </label>
                                    </div>
                                    <div className="form-check">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            onChange={handleChange}
                                            name="type"
                                            value="text"
                                            id="flex-dinamis4"
                                        />
                                        <label className="form-check-label" htmlFor="flex-dinamis4">
                                            text
                                        </label>
                                    </div>
                                </div>


                                {formDesign?.type == 'text' && (
                                    <div className="mb-3 ">
                                        <label htmlFor="ssds" className="form-label">
                                            Sub Type :
                                        </label>
                                        <div className="form-check">
                                            <input
                                                className="form-check-input"
                                                type="radio"
                                                onChange={handleChange}
                                                name="sub_type"
                                                id="sub_type1"
                                                value="amount"
                                            />
                                            <label className="form-check-label" htmlFor="sub_type1">
                                                amount
                                            </label>
                                        </div>
                                        <div className="form-check">
                                            <input
                                                className="form-check-input"
                                                type="radio"
                                                onChange={handleChange}
                                                name="sub_type"
                                                id="sub_type2"
                                                value="date"
                                            />
                                            <label className="form-check-label" htmlFor="sub_type2">
                                                date
                                            </label>
                                        </div>
                                        <div className="form-check">
                                            <input
                                                className="form-check-input"
                                                type="radio"
                                                onChange={handleChange}
                                                name="sub_type"
                                                id="sub_type3"
                                                value="text"
                                            />
                                            <label className="form-check-label" htmlFor="sub_type3">
                                                text
                                            </label>
                                        </div>

                                    </div>
                                )}

                                {formDesign?.type == 'radio_button' || formDesign?.type == 'checkbox' ? (
                                    <div className="mb-3 ">
                                        <label htmlFor="ssds" className="form-label">
                                            Options:
                                        </label>


                                        <div className='d-flex row'>

                                            <div className='d-flex flex-column row'>
                                                {formDesign?.options?.length > 0 ? formDesign?.options?.map((d, i) => {
                                                    return (
                                                        <div className="input-group mb-3" key={i}>

                                                            <input
                                                                type="text"
                                                                className="form-control"
                                                                placeholder="label"
                                                                value={d?.label}
                                                                aria-describedby="basic-addon1"
                                                                onChange={(e) => handleChangeOptions(e, i)}
                                                            />
                                                            <span className="input-group-text" id="basic-addon1">
                                                                <button
                                                                    onClick={() => handleDeleteOptions(d)}

                                                                    type="button" className="btn btn-sm  btn-danger ">
                                                                    <TrashIcon />
                                                                </button>

                                                            </span>
                                                        </div>
                                                    )
                                                }) : (
                                                    <>null</>
                                                )}

                                                <div className='d-flex justify-content-center'>
                                                    <button
                                                        onClick={() => addOptions()}
                                                        type="button" style={{ width: "200px" }} className="btn btn-sm btn-primary">
                                                        <PlusIcon /> add options
                                                    </button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                ) : null}

                            </>


                        </div>
                        <div className="modal-footer">
                            <button
                                type="button"
                                onClick={() => handleClear()}
                                className="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                data-bs-dismiss="modal"
                                type="submit" className="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    )
}