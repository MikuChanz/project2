import { useEffect, useState } from 'react';
import '../css/loader.css';

// Header and footer components
const topIDs = [
    {
        "id": 1,
        "name": "Solemn Lament",
        "description": "A Lobotomy E.G.O identity connected to abnormality equipment and unstable power.",
        "sinner": "Yi Sang",
        "association": "Lobotomy E.G.O",
        "rarity": "000",
        "season": "4",
        "release_year": 2024,
        "image": "http://project2/images/6a41d35d5c44f.png"
    },
    {
        "id": 2,
        "name": "The Middle Big Brother",
        "description": "A syndicate identity connected to The Middle, focused on loyalty, retaliation, and brutal close-range combat.",
        "sinner": "Heathcliff",
        "association": "The Middle",
        "rarity": "000",
        "season": "7",
        "release_year": 2026,
        "image": "http://project2/images/6a41d7e8ef895.png"
    }
];

const selectedID = {
    "id": 1,
    "name": "Solemn Lament",
    "description": "A Lobotomy E.G.O identity connected to abnormality equipment and unstable power.",
    "sinner": "Yi Sang",
    "association": "Lobotomy E.G.O",
    "rarity": "000",
    "season": "4",
    "release_year": 2024,
    "image": "http://project2/images/6a41d35d5c44f.png"
};

const relatedIDs = [
    {
        "id": 2,
        "name": "The Middle Big Brother",
        "description": "A syndicate identity connected to The Middle, focused on loyalty, retaliation, and brutal close-range combat.",
        "sinner": "Heathcliff",
        "association": "The Middle",
        "rarity": "000",
        "season": "7",
        "release_year": 2026,
        "image": "http://project2/images/6a41d7e8ef895.png"
    }
];

// Header and footer components
function Header() {
    return (
        <header className="bg-green-500 mb-8 py-2 sticky top-0">
            <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6 md:container md:mx-auto">
                Limbus Company Identities
            </div>
        </header>
    );
}

function Footer() {
    return (
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                Mikus Valts, VeA, 2026
            </div>
        </footer>
    );
}

// "See more" button
function SeeMoreBtn({ idID, handleIDSelection }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bg-sky-400 text-sky-50 cursor-pointer"
            onClick={() => handleIDSelection(idID)}
        >
            See more
        </button>
    );
}

// Homepage - loads data from API and displays top IDs
function Homepage({ handleIDSelection }) {
    const [topIDs, setTopIDs] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchTopIDs() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch('/data/get-top-ids');

                if (!response.ok) {
                    throw new Error('Data loading error. Please reload the page!');
                }

                const data = await response.json();

                console.log('top IDs fetched', data);

                setTopIDs(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchTopIDs();
    }, []);

    return (
        <>
            {isLoading && <Loader />}

            {error && <ErrorMessage msg={error} />}

            {!isLoading && !error && (
                <>
                    {topIDs.map((id, index) => (
                        <TopIDView
                            id={id}
                            key={id.id}
                            index={index}
                            handleIDSelection={handleIDSelection}
                        />
                    ))}
                </>
            )}
        </>
    );
}

// Top ID view - displays homepage identities
function TopIDView({ id, index, handleIDSelection }) {
    return (
        <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
            <div
                className={
                    'order-2 px-12 md:basis-1/2 ' +
                    (index % 2 === 1 ? 'md:order-1 md:text-right' : '')
                }
            >
                <h2 className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                    {id.name}
                </h2>

                <p className="mb-4 text-xl leading-7 font-light text-neutral-900">
                    {id.description
                        ? id.description.split(' ').slice(0, 16).join(' ') + '...'
                        : ''}
                </p>

                <SeeMoreBtn
                    idID={id.id}
                    handleIDSelection={handleIDSelection}
                />
            </div>

            <div
                className={
                    'order-1 md:basis-1/2 ' +
                    (index % 2 === 1 ? 'md:order-2' : '')
                }
            >
                <img
                    src={id.image}
                    alt={id.name}
                    className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto"
                />
            </div>
        </div>
    );
}

// Identity page
function IDPage({ selectedIDID, handleIDSelection, handleGoingBack }) {
    return (
        <>
            <SelectedIDView
                selectedIDID={selectedIDID}
                handleGoingBack={handleGoingBack}
            />

            <RelatedIDSection
                selectedIDID={selectedIDID}
                handleIDSelection={handleIDSelection}
            />
        </>
    );
}

// Related identity view
function RelatedIDView({ id, handleIDSelection }) {
    return (
        <div className="bg-neutral-100 rounded-lg mb-4 p-4 md:basis-1/3">
            <img
                src={id.image}
                alt={id.name}
                className="p-1 rounded-md border border-neutral-200 w-full mb-4"
            />

            <h3 className="mb-2 text-xl leading-6 font-light text-neutral-900">
                {id.name}
            </h3>

            <p className="mb-2 text-neutral-900">
                {id.sinner}
            </p>

            <p className="mb-4 text-neutral-900">
                {id.association}
            </p>

            <SeeMoreBtn
                idID={id.id}
                handleIDSelection={handleIDSelection}
            />
        </div>
    );
}

// Related identities section
function RelatedIDSection({ selectedIDID, handleIDSelection }) {
    const [relatedIDs, setRelatedIDs] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchRelatedIDs() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch(
                    '/data/get-related-ids/' + selectedIDID
                );

                if (!response.ok) {
                    throw new Error('Data loading error. Please reload the page!');
                }

                const data = await response.json();

                console.log('related IDs for ' + selectedIDID + ' fetched', data);

                setRelatedIDs(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchRelatedIDs();
    }, [selectedIDID]);

    return (
        <>
            {isLoading && <Loader />}

            {error && <ErrorMessage msg={error} />}

            {!isLoading && !error && (
                <>
                    <div className="flex flex-wrap">
                        <h2 className="text-3xl leading-8 font-light text-neutral-900 mb-4">
                            Related identities
                        </h2>
                    </div>

                    <div className="flex flex-wrap md:flex-row md:space-x-4 md:flex-nowrap">
                        {relatedIDs.map((id) => (
                            <RelatedIDView
                                id={id}
                                key={id.id}
                                handleIDSelection={handleIDSelection}
                            />
                        ))}
                    </div>
                </>
            )}
        </>
    );
}

// Button "Back to start"
function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-neutral-500 hover:bg-neutral-400 text-neutral-50 cursor-pointer"
            onClick={handleGoingBack}
        >
            To start
        </button>
    );
}

// Selected identity view
function SelectedIDView({ selectedIDID, handleGoingBack }) {
    const [selectedID, setSelectedID] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchSelectedID() {
            try {
                setIsLoading(true);
                setError(null);

                const response = await fetch('/data/get-id/' + selectedIDID);

                if (!response.ok) {
                    throw new Error('Data loading error. Please reload the page!');
                }

                const data = await response.json();

                console.log('ID ' + selectedIDID + ' fetched', data);

                setSelectedID(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchSelectedID();
    }, [selectedIDID]);

    return (
        <>
            {isLoading && <Loader />}

            {error && <ErrorMessage msg={error} />}

            {!isLoading && !error && (
                <>
                    <div className="rounded-lg flex flex-wrap md:flex-row">
                        <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                            <h1 className="text-3xl leading-8 font-light text-neutral-900 mb-2">
                                {selectedID.name}
                            </h1>

                            <p className="text-xl leading-7 font-light text-neutral-900 mb-2">
                                {selectedID.sinner}
                            </p>

                            <p className="text-xl leading-7 font-light text-neutral-900 mb-4">
                                {selectedID.description}
                            </p>

                            <dl className="mb-4 md:flex md:flex-wrap md:flex-row">
                                <dt className="font-bold md:basis-1/4">
                                    Release year
                                </dt>
                                <dd className="mb-2 md:basis-3/4">
                                    {selectedID.release_year}
                                </dd>

                                <dt className="font-bold md:basis-1/4">
                                    Rarity
                                </dt>
                                <dd className="mb-2 md:basis-3/4">
                                    {selectedID.rarity}
                                </dd>

                                <dt className="font-bold md:basis-1/4">
                                    Season
                                </dt>
                                <dd className="mb-2 md:basis-3/4">
                                    {selectedID.season}
                                </dd>

                                <dt className="font-bold md:basis-1/4">
                                    Faction
                                </dt>
                                <dd className="mb-2 md:basis-3/4">
                                    {selectedID.association}
                                </dd>
                            </dl>
                        </div>

                        <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                            <img
                                src={selectedID.image}
                                alt={selectedID.name}
                                className="p-1 rounded-md border border-neutral-200 mx-auto"
                            />
                        </div>
                    </div>

                    <div className="mb-12 flex flex-wrap">
                        <GoBackBtn handleGoingBack={handleGoingBack} />
                    </div>
                </>
            )}
        </>
    );
}

// Loading indicator and error message
function Loader() {
    return (
        <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
            <div className="loader"></div>
        </div>
    );
}

function ErrorMessage({ msg }) {
    return (
        <div className="md:container md:mx-auto bg-red-300 my-8 p-2">
            <p className="text-black">{msg}</p>
        </div>
    );
}

// Main application component
export default function App() {
    const [selectedIDID, setSelectedIDID] = useState(null);

    // Function that saves selected identity ID in state
    function handleIDSelection(idID) {
        setSelectedIDID(idID);
    }

    // Function that clears selected identity ID
    function handleGoingBack() {
        setSelectedIDID(null);
    }

    return (
        <>
            <Header />

            <main className="mb-8 px-2 md:container md:mx-auto">
                {
                    selectedIDID
                        ? <IDPage
                            selectedIDID={selectedIDID}
                            handleIDSelection={handleIDSelection}
                            handleGoingBack={handleGoingBack}
                        />
                        : <Homepage
                            handleIDSelection={handleIDSelection}
                        />
                }
            </main>

            <Footer />
        </>
    );
}