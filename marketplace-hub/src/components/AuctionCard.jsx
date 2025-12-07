import '@/styles/Auctions.css';

export const AuctionCard = ({
  id,
  pocetnaCena,
  krajnjaCena,
  datumPocetka,
  datumKraja,
  opis,
}) => {
  return (
    <div className="auction-card">
      <h3>Auction</h3>
      <div className="auction-info">
        <p><strong>Starting Price:</strong> ${pocetnaCena}</p>
        {krajnjaCena && <p><strong>Current Price:</strong> ${krajnjaCena}</p>}
        <p><strong>Start:</strong> {new Date(datumPocetka).toLocaleDateString()}</p>
        <p><strong>End:</strong> {new Date(datumKraja).toLocaleDateString()}</p>
        {opis && <p>{opis}</p>}
      </div>
    </div>
  );
};
