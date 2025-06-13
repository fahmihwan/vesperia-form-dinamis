import { useEffect, useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import axios from 'axios';
import { BASE_URL } from './constants/config';
import moment from 'moment';
import { EditIcon, TrashIcon } from './components/IconCompt';
import { ModalEl } from './components/ModalCompt';
import FormDesignCompt from './components/FormDesignCompt';
import AnswerQuestion from './components/AnswerQuestion';
// import 'moment/locale/id';

function App() {


    const [title, setTitle] = useState('')


    const [forms, setForms] = useState({});         // state untuk menyimpan data
    const [loading, setLoading] = useState(true);   // state untuk loading
    const [error, setError] = useState(null);       // state untuk error

    const [updateId, setUpdateId] = useState(null)

    const [paginatePage, setPaginatePage] = useState(1);
    const [paginateLastPage, setPaginateLatesPage] = useState(1);
    const [paginateFrom, setPaginateFrom] = useState(1)


    const [formDinamis, setFormDinamis] = useState(null)

    const [isMenuQuestion, setMenuQuestion] = useState(null)





    const fetchData = async (pageNumber = 1) => {
        try {
            const response = await axios.get(`${BASE_URL}/forms?page=${pageNumber}`);
            setForms(response.data.data.data);
            setPaginateFrom(response.data.data.from)
            setPaginatePage(response.data.data.current_page)
            setPaginateLatesPage(response.data.data.last_page);

        } catch (err) {
            setError('Terjadi kesalahan saat mengambil data');
        } finally {
            setLoading(false);
        }
    };


    useEffect(() => {
        fetchData(paginatePage);
    }, [paginatePage]);

    if (loading) return <p>Loading...</p>;
    if (error) return <p>{error}</p>;




    const submitForm = async () => {
        try {
            if (updateId != null) {
                await axios.put(`${BASE_URL}/form/${updateId}`, {
                    "name": title
                });
            } else {
                await axios.post(`${BASE_URL}/form`, {
                    "name": title
                });
            }
            setTitle('');
            fetchData(paginatePage);
        } catch (err) {
            alert('Terjadi kegagalan');
        }
    };





    const handlePageChange = (pageNumber) => {
        if (pageNumber >= 1 && pageNumber <= paginateLastPage) {
            fetchData(pageNumber);
        }
    };

    const findForm = async (id) => {
        try {

            const data = await axios.get(`${BASE_URL}/form-dinamis/${id}`);
            setFormDinamis(data.data.data);
            setTitle('');
            fetchData(paginatePage);
        } catch (err) {
            alert('Terjadi kegagalan');
        }
    }

    const deleteForm = async (id) => {
        const isConfirmed = window.confirm("Apakah Anda yakin ingin menghapus data ini?");
        if (!isConfirmed) return;

        try {
            const data = await axios.delete(`${BASE_URL}/form/${id}`);
            setFormDinamis(data.data.data);
            setTitle('');
            fetchData(paginatePage);
            findForm(id)
        } catch (err) {
            alert('Terjadi kegagalan');
        }
    }



    return (
        <>

            <div className="container-fluid">
                <h1>TasK VESPERIA </h1>


                <div className='row'>
                    <div className='col-md-6'>

                        <button
                            type="button"
                            onClick={() => {
                                setTitle("")
                                setUpdateId(null)
                            }}
                            className="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            Create Form Title
                        </button>

                        <table className="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {forms?.map((d, i) => {
                                    return (
                                        <tr key={i}>
                                            <th scope="row">{paginateFrom + i}</th>
                                            <td>{d?.name}</td>
                                            <td>{moment(d?.created_at).format('dddd, D MMMM YYYY')}</td>
                                            <td>
                                                <button
                                                    type="button"
                                                    onClick={() => {
                                                        setTitle(d?.name)
                                                        setUpdateId(d?.id)
                                                    }}
                                                    className="btn btn-sm btn-warning me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                >
                                                    <EditIcon />
                                                </button>
                                                <button
                                                    onClick={() => deleteForm(d?.id)}
                                                    type="button" className="btn btn-sm btn-danger me-2">
                                                    <TrashIcon />
                                                </button>


                                                <button onClick={() => {
                                                    findForm(d?.id)
                                                    setMenuQuestion('CREATE')
                                                }} type="button" className="btn  btn-sm btn-primary me-2">
                                                    Create Question
                                                </button>



                                                <button onClick={() => {
                                                    findForm(d?.id)
                                                    setMenuQuestion('ANSWER')
                                                }} type="button" className="btn btn-sm btn-info">
                                                    Answer Simulation
                                                </button>




                                            </td>
                                        </tr>
                                    )
                                })}

                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" style={{ marginTop: '20px' }}>
                            <ul className="pagination">
                                <li className={`page-item ${paginatePage === 1 ? 'disabled' : ''}`}>
                                    <button className="page-link" onClick={() => handlePageChange(paginatePage - 1)}>
                                        Previous
                                    </button>
                                </li>

                                {[...Array(paginateLastPage)].map((_, index) => {
                                    const pageNumber = index + 1;
                                    return (
                                        <li
                                            key={pageNumber}
                                            className={`page-item ${paginatePage === pageNumber ? 'active' : ''}`}
                                        >
                                            <button className="page-link" onClick={() => handlePageChange(pageNumber)}>
                                                {pageNumber}
                                            </button>
                                        </li>
                                    );
                                })}


                                <li className={`page-item ${paginatePage === paginateLastPage ? 'disabled' : ''}`}>
                                    <button className="page-link" onClick={() => handlePageChange(paginatePage + 1)}>
                                        Next
                                    </button>
                                </li>
                            </ul>
                            {paginatePage === paginateLastPage}
                        </nav>

                        <div className='mt-5'>
                            <h5>DEBUG JSON</h5>
                            <div style={{ height: "1000px", overflow: "auto" }}>
                                <pre style={{
                                    backgroundColor: '#f4f4f4',
                                    padding: '15px',
                                    borderRadius: '5px',
                                    fontFamily: 'monospace',
                                    whiteSpace: 'pre-wrap',     // atau 'pre' kalau mau horizontal scroll
                                    wordBreak: 'break-word',    // optional, biar teks gak overflow
                                    margin: 0
                                    // backgroundColor: '#f4f4f4',
                                    // padding: '15px',
                                    // borderRadius: '5px',
                                    // fontFamily: 'monospace',
                                    // overflowX: 'auto'
                                }}>
                                    {JSON.stringify(formDinamis, null, 2)}
                                </pre>
                            </div>

                        </div>

                    </div>
                    <div className='col-md-6'>


                        {

                            isMenuQuestion == 'CREATE' ? (
                                <FormDesignCompt
                                    isMenuQuestion={isMenuQuestion}
                                    setMenuQuestion={setMenuQuestion}
                                    formDinamis={formDinamis} setFomrDinamis={setFormDinamis} findForm={findForm} />
                            ) : isMenuQuestion == 'ANSWER' ? (<AnswerQuestion
                                isMenuQuestion={isMenuQuestion}
                                setMenuQuestion={setMenuQuestion}
                                formDinamis={formDinamis} setFomrDinamis={setFormDinamis} findForm={findForm} />) : null

                        }



                    </div>
                </div>
            </div>


            <ModalEl setTitle={setTitle} title={title} submitForm={submitForm} />





        </>
    )
}

export default App


