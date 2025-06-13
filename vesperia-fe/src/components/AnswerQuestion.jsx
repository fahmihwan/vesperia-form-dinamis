import { useEffect, useState } from 'react'

import axios from 'axios';
// import { BASE_URL } from './constants/config';
import moment from 'moment'; import { PlusIcon, TrashIcon } from './IconCompt';
import { ModalDesignEl } from './ModalCompt';
import { BASE_URL } from '../constants/config';


// isMenuQuestion={isMenuQuestion}
// setMenuQuestion={setMenuQuestion}
function AnswerQuestion({ formDinamis, setFomrDinamis, findForm, setMenuQuestion, isMenuQuestion }) {


    const [formDesign, setFormDesign] = useState({});



    useEffect(() => {
        if (formDesign?.type == 'radio_button') {


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
    console.log(formDesign?.options);







    const handleSubmitQuestion = async () => {

        let payloads = formDinamis?.payloads

        let obj = payloads.map((d) => {
            return {
                id: d.id,
                answer: d.answer,
                parent_id: d?.parent_id,
            }
        })

        try {
            let data = await axios.post(`${BASE_URL}/form-answer`, {
                items: obj
            });
            alert('Data Berhasil Di simpan');
            // return data;
        } catch (err) {
            alert('Terjadi kegagalan');
        }

        findForm(formDinamis?.id)




    }


    const handleChange = (id, newValue, type = false) => {

        const updatedPayloads = formDinamis.payloads.map(payload => {
            if (payload.id === id) {

                if (type === "checkbox") {
                    const isChecked = payload.answer.value.includes(newValue);
                    const updatedValues = isChecked
                        ? payload.answer.value.filter(val => val !== newValue)
                        : [...payload.answer.value, newValue];

                    return {
                        ...payload,
                        answer: {
                            ...payload.answer,
                            value: updatedValues,
                        }
                    };
                } else {
                    return {
                        ...payload,
                        answer: {
                            ...payload.answer,
                            value: newValue
                        }
                    };
                }

            }
            return payload;
        });

        setFomrDinamis(prev => ({
            ...prev,
            payloads: updatedPayloads
        }));

    };








    // console.log(formDesign)



    return (
        <>

            {formDinamis && (
                <div className='card bg-secondary'>
                    <div className='d-flex justify-content-between align-items-center card-header'>

                        <h5 className="card-title text-light">Answer Questions Simulation </h5>

                        <button
                            onClick={() => setMenuQuestion(null)}
                            type="button" className="btn btn-sm rounded-circle btn-warning">
                            close
                        </button>


                    </div>

                    <div className='card-body px-5'>
                        <div className="card mt-5">
                            <div className="card-header">Form {formDinamis?.name}</div>
                            <div className="card-body">
                                {/* {JSON.stringify(formDinamis)} */}
                                <>
                                    {
                                        formDinamis?.payloads?.map((d, i) => {
                                            return (
                                                <div className='mb-5' key={i}>
                                                    <label htmlFor="" className="">{i + 1}.  {d?.label} ({d?.description}) </label>
                                                    <div className="mb-3">
                                                        {d?.type == 'radio_button' && d?.options?.map((x, i) => (
                                                            <div className="" key={i}>

                                                                <input
                                                                    className="form-check-input me-2"
                                                                    type="radio"
                                                                    checked={d?.answer?.value[0]?.label === x.label}
                                                                    name={d?.id}
                                                                    id={x?.id}
                                                                    onChange={() =>
                                                                        handleChange(d.id, [{ ...x }])
                                                                    }
                                                                />
                                                                <label className="form-check-label" htmlFor={x?.id}>
                                                                    {x?.label}
                                                                </label>
                                                            </div>
                                                        ))}

                                                        {d?.type == 'checkbox' && d?.options?.map((x, i) => (
                                                            <div className="form-check" key={i + "z"}>
                                                                <input
                                                                    className="form-check-input"
                                                                    type="checkbox"
                                                                    checked={d?.answer?.value?.includes(x.id)}
                                                                    onChange={() => {
                                                                        handleChange(d.id, x.id, 'checkbox')
                                                                    }}
                                                                    id={`flexCheckDefault${i}`}
                                                                />
                                                                <label className="form-check-label" htmlFor={`flexCheckDefault${i}`}>
                                                                    {x?.label}
                                                                </label>
                                                            </div>

                                                        ))}

                                                        {d?.type == 'text' && d?.sub_type == 'date' && (
                                                            <div className="">
                                                                <input type="date"
                                                                    value={d?.answer?.value}
                                                                    onChange={(e) => handleChange(d.id, e.target.value)}
                                                                    className="form-control" />
                                                            </div>
                                                        )}

                                                        {d?.type == 'text' && d?.sub_type == 'amount' && (
                                                            <div className="">

                                                                <input type="number"
                                                                    value={d?.answer?.value}
                                                                    onChange={(e) => handleChange(d.id, e.target.value)}
                                                                    className="form-control" id="exampleInputPassword1" />
                                                            </div>
                                                        )}

                                                        {d?.type == 'text' && d?.sub_type == 'text' && (
                                                            <div className="">
                                                                <input type="text"
                                                                    value={d?.answer?.value}
                                                                    onChange={(e) => handleChange(d.id, e.target.value)}
                                                                    className="form-control" />
                                                            </div>
                                                        )}



                                                        {d?.type == 'long_text' && (

                                                            <div className="">
                                                                <textarea
                                                                    className="form-control"
                                                                    id="floatingTextarea2"
                                                                    onChange={(e) => handleChange(d.id, e.target.value)}
                                                                    style={{ height: 100 }}
                                                                    value={d?.answer?.value}
                                                                />

                                                            </div>

                                                        )}

                                                    </div>

                                                </div>

                                            )
                                        })
                                    }
                                    <button
                                        onClick={() => handleSubmitQuestion()}
                                        type="submit" className="btn btn-primary">
                                        Submit
                                    </button>

                                </>
                            </div>
                        </div>
                    </div>

                </div>

            )}




        </>
    )
}

export default AnswerQuestion


