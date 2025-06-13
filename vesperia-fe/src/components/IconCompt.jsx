

export const EditIcon = ({ width = 24, height = 24, color = 'currentColor' }) => (
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke={color}
        strokeWidth={2}
        width={width}
        height={height}
    >
        <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-6.586.586L9 11z"
        />
    </svg>
);

export const TrashIcon = ({ width = 24, height = 24, color = 'currentColor' }) => (
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width={width}
        height={height}
        fill="none"
        viewBox="0 0 24 24"
        stroke={color}
        strokeWidth={2}
    >
        <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-2h2a1 1 0 011 1v1H8V6a1 1 0 011-1z"
        />
    </svg>
);


export const PlusIcon = ({ size = 24, color = 'white' }) => {
    return (
        <svg
            width={size}
            height={size}
            viewBox="0 0 24 24"
            fill="none"
            stroke={color}
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
    );
};