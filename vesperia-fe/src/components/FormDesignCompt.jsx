import { useEffect, useRef, useState } from 'react'

import axios from 'axios';

import moment from 'moment'; import { PlusIcon, TrashIcon } from './IconCompt';
import { ModalDesignEl } from './ModalCompt';
import { BASE_URL } from '../constants/config';
;

function FormDesignCompt({ formDinamis, findForm, setMenuQuestion, isMenuQuestion }) {

    const formRef = useRef(null);

    const [formDesign, setFormDesign] = useState({});

    const handleClear = () => {
        formRef.current.reset();
        setFormDesign({})
    };
    useEffect(() => {
        if (formDesign?.type == 'radio_button' || formDesign?.type == 'checkbox') {


            if (!Array.isArray(formDesign.options) || formDesign.options.length === 0) {
                setFormDesign((prev) => ({
                    ...prev,
                    options: [
                        {
                            "id": 0,
                            "value": "",
                            "parent_id": "",
                            "label": ""
                        },
                    ]
                }))
            }


        } else {
            if (!Array.isArray(formDesign.options) || formDesign.options.length === 0) {
                setFormDesign((prev) => ({
                    ...prev,
                    options: []
                }))
            }
        }
    }, [formDesign?.type])
    // console.log(formDesign?.options);





    // const findForm = async (id) => {
    //     try {

    //         const data = await axios.get(`${BASE_URL}/form-dinamis/${id}`);
    //         setFormDinamis(data.data.data);
    //         setTitle('');
    //         fetchData(paginatePage);
    //     } catch (err) {
    //         alert('Terjadi kegagalan');
    //     }

    // }



    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormDesign(prev => ({
            ...prev,
            [name]: value
        }));
    };



    const handleSubmitDesign = async (e) => {
        e.preventDefault()
        // console.log(formDinamis);


        const requiredProps = [
            "type",
            // "answer",
            "supporting_file",
            "parent_id",
            "sub_type",
            "orm_only",
            "description",
            "options",
            "sub_payloads"
        ];

        let obj = formDesign




        if (!('sub_type' in obj)) {
            obj.sub_type = 'dsdswkkwkw'
        }


        if (!('supporting_file' in obj)) {
            obj.supporting_file = {
                name: '',
                value: ''
            };

        }

        obj.answer = {
            "name": '',
            "value": null
        }

        obj.parent_id = formDinamis?.id
        obj.orm_only = "no"
        obj.sub_payloads = []

        const validateMissingFields = (obj, requiredKeys) => {
            const missing = [];

            requiredKeys.forEach((key) => {
                if (!(key in obj)) {
                    missing.push(key);
                } else {
                    const val = obj[key];
                    if (
                        val === null ||
                        val === undefined ||
                        (typeof val === 'string' && val.trim() === '')
                    ) {
                        missing.push(key);
                    }
                }
            });

            return missing;
        };
        const missing = validateMissingFields(obj, requiredProps);



        if (missing.length > 0) {
            console.log("Field berikut belum ada atau kosong:", missing);
        } else {
            // alert("Semua field lengkap ");
            try {
                let data = await axios.post(`${BASE_URL}/form-design`, obj);
                // return data;
            } catch (err) {
                alert('Terjadi kegagalan');
            }

            findForm(formDinamis?.id)
            handleClear()
        }


        // let obj = {}
        // obj = formDesign

        // if (formDesign?.options?.length > 0) {
        //     obj.options = formDesign?.options
        // }
        // console.log(obj);

    }



    const handleDeleteOptions = (d) => {
        const updatedOptions = formDesign.options?.filter((x) => x.id !== d?.id);
        console.log(updatedOptions);
        setFormDesign((prev) => ({
            ...prev,
            options: updatedOptions
        }));

    }



    const handleChangeOptions = (e, i) => {

        const updatedOptions = [...formDesign.options];
        updatedOptions[i] = {
            ...updatedOptions[i],
            label: e.target.value
        };

        setFormDesign((prev) => ({
            ...prev,
            options: updatedOptions
        }));

    }

    const addOptions = () => {

        const options = formDesign?.options || [];
        const lastId = options?.length > 0
            ? Math.max(...options.map(opt => typeof opt.id === 'number' ? opt.id : 0))
            : 0;

        const newOption = {
            id: lastId + 1,
            label: "",
            value: "",
            parent_id: formDesign.id || ""
        };

        setFormDesign(prev => ({
            ...prev,
            options: [...options, newOption]
        }));
    }

    const handleDeletePayload = async (id) => {

        try {
            let data = await axios.delete(`${BASE_URL}/form-design/${id}`);
            // return data;
        } catch (err) {
            alert('Terjadi kegagalan');
        }

        await findForm(formDinamis?.id)
        handleClear()
        // /form-design/{id}
    }

    return (
        <>


            {formDinamis && (
                <div className='card bg-secondary'>
                    <div className='d-flex justify-content-between align-items-center card-header'>

                        <h5 className="card-title text-light">Create Form Design</h5>
                        <div>
                            <button
                                type="button"
                                className="btn btn-primary me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop1"
                            >
                                Add Question
                            </button>

                            <button
                                onClick={() => setMenuQuestion(null)}
                                type="button" className="btn btn-sm rounded-circle btn-warning">
                                close
                            </button>
                        </div>

                    </div>

                    <div className='card-body px-5'>
                        <div className="card mt-5">
                            <div className="card-header">Form {formDinamis?.name}</div>
                            <div className="card-body">

                                <>
                                    {
                                        formDinamis?.payloads?.map((d, i) => {
                                            return (
                                                <div className='mb-5 row  border-bottom  align-items-center' key={i}>

                                                    <div className='col-md-11'>
                                                        <label htmlFor="" className="">{i + 1}.  {d?.label} ({d?.description}) </label>


                                                        <div className="mb-3">

                                                            {d?.type == 'radio_button' ? d?.options?.map((x, i) => (
                                                                <div className="" key={i}>
                                                                    <input
                                                                        className="form-check-input me-2"
                                                                        type="radio"
                                                                        name="flexRadioDefault"
                                                                        id="flexRadioDefault1"
                                                                    />
                                                                    <label className="form-check-label" htmlFor="flexRadioDefault1">
                                                                        {x?.label}
                                                                    </label>
                                                                </div>
                                                            )) : null}


                                                            {d?.type == 'checkbox' && d?.options?.map((x, i) => (

                                                                <div className="form-check" key={i + 'y'}>
                                                                    <input
                                                                        className="form-check-input"
                                                                        type="checkbox"
                                                                        defaultValue=""
                                                                        id="flexCheckDefault"
                                                                    />
                                                                    <label className="form-check-label" htmlFor="flexCheckDefault">
                                                                        {x.label}
                                                                    </label>
                                                                </div>

                                                            ))}
                                                            {d?.type == 'text' && d?.sub_type == 'date' && (
                                                                <div className="">
                                                                    <input type="date" className="form-control" />
                                                                </div>

                                                            )}

                                                            {d?.type == 'text' && d?.sub_type == 'amount' && (
                                                                <div className="">
                                                                    <input type="number"

                                                                        className="form-control" id="exampleInputPassword1" />
                                                                </div>
                                                            )}

                                                            {d?.type == 'text' && d?.sub_type == 'text' && (
                                                                <div className="">
                                                                    <input type="text"

                                                                        className="form-control" id="exampleInputPassword1" />
                                                                </div>
                                                            )}




                                                            {d?.type == 'long_text' && (

                                                                <div className="">

                                                                    <textarea
                                                                        className="form-control"

                                                                        id="floatingTextarea2"
                                                                        style={{ height: 100 }}
                                                                        defaultValue={""}
                                                                    />

                                                                </div>

                                                            )}

                                                        </div>
                                                    </div>
                                                    <div className='col-md-1'>
                                                        <button
                                                            onClick={() => handleDeletePayload(d?.id)}
                                                            type="button" className="btn btn-sm btn-danger">
                                                            <TrashIcon />
                                                        </button>
                                                    </div>
                                                </div>

                                            )
                                        })
                                    }
                                </>
                            </div>
                        </div>
                    </div>
                </div>

            )}




            <ModalDesignEl
                formRef={formRef}
                handleClear={handleClear}
                handleSubmitDesign={handleSubmitDesign} handleChange={handleChange} handleChangeOptions={handleChangeOptions}
                handleDeleteOptions={handleDeleteOptions} addOptions={addOptions} formDesign={formDesign} />

        </>
    )
}

export default FormDesignCompt


